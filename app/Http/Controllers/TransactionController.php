<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Transaction;

class TransactionController extends Controller
{

    public function pemesanan_kelasprofit()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $transaction = Transaction::where('user_id', $user->id)
                                        ->where('kelas_id', 1)
                                        ->first();
            if ($transaction) {
                if ($transaction->status_pembayaran == 'paid') {
                    return redirect()->route('kelas.profit.1');
                } elseif ($transaction->status_pembayaran == 'unpaid' && $transaction->batas_bayar >= now()) {
                    return redirect()->route('pemesanan.invoice', [ 'uuid' => $transaction->uuid]);
                } elseif ($transaction->status_pembayaran == 'unpaid' && $transaction->batas_bayar < now()) {
                    return view('pages.pemesanan');
                }
            }
        }
        return view('pages.pemesanan');
    }

    public function pemesanan_kelasprofit_store(Request $request)
    {
        if (!Auth::check()) {
            $request->validate([
                'name'           => ['required', 'string', 'max:255'],
                'email'          => ['required', 'string', 'email', 'max:255'],
                'phone_number'   => ['required', 'string', 'max:15'],
                'phone_code'     => ['max:6'],
                'password'       => ['required', 'min:6'],
                'payment_method' => ['required'],
            ]);

            // Menghapus karakter '0' di awal nomor telepon yang dimasukkan oleh pengguna
            $phone_number = ltrim($request->phone_number, '0');

            // Cek apakah user sudah ada di database
            $user = User::where('email', $request->email)
                        ->orWhere('phone_number', $phone_number)
                        ->first();

            if (!$user) {
                $user = User::create([
                    'name'         => $request->name,
                    'email'        => $request->email,
                    'phone_code'   => $request->phone_code ?? '62',
                    'phone_number' => $phone_number,
                    'password'     => Hash::make($request->password),
                ]);
            }
        } else {
            $request->validate([
                'payment_method' => ['required'],
            ]);
            $user = Auth::user();
        }

        // Kode ini memicu event Registered setelah pengguna baru berhasil didaftarkan.
        // event(new Registered($user));

        // Auth::login($user);


        // $va           = '1179001364818964'; //get on iPaymu dashboard
        // $apiKey       = '516A6C4F-D5F7-4D3B-AC26-18FFFEEF3B87'; //get on iPaymu dashboard

        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode

        $method       = 'POST'; //method

        if ($request->payment_method == 'qris') {
            $method_ = 'qris';
            $channel_ = 'mpm';
        } else {
            $method_ = 'va';
            $channel_ = $request->payment_method;
        }

        //Request Body//
        $body    = [
            'product'        => ['Kelas Profit 10 Juta'],
            'qty'            => ['1'],
            'price'          => ['57000'],
            'amount'         => '57000',
            'returnUrl'      => 'https://kelasentrepreneurid.com/pemesanan/selesai',
            'cancelUrl'      => 'https://kelasentrepreneurid.com/pemesanan/cancel',
            'notifyUrl'      => 'https://kelasentrepreneurid.com/pemesanan/callback',
            'referenceId'    => Str::uuid(),
            'paymentMethod'  => $method_,
            'paymentChannel' => $channel_,
            'feeDirection'   => 'BUYER',
            'expired'        => '1',
            'name'           => $user->name,
            'email'          => $user->email,
            'phone'          => $user->phone_code . $user->phone_number,
        ];
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp    = Date('YmdHis');
        //End Generate Signature

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp,
        ])->post($url, $body);

        $status_api = $response->json();

        if ($status_api['Status'] == 200) {
            $transactionId = $status_api['Data']['TransactionId'];

            $body_c    = [
                'transactionId' => $transactionId,
                'account' => $va
            ];

            $jsonBody     = json_encode($body_c, JSON_UNESCAPED_SLASHES);
            $requestBody  = strtolower(hash('sha256', $jsonBody));
            $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
            $signature_   = hash_hmac('sha256', $stringToSign, $apiKey);
            $timestamp_   = Date('YmdHis');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'signature'    => $signature_,
                'va'           => $va,
                'timestamp'    => $timestamp_,
            ])->post('https://sandbox.ipaymu.com/api/v2/transaction', [
                'transactionId' => $transactionId,
                'account'       => $va
            ]);

            $cek = $response->json();

            $simpan = Transaction::create([
                'uuid'              => $cek['Data']['SessionId'],
                'user_id'           => $user->id,
                'kelas_id'          => 1,
                'id_ipaymu'         => $cek['Data']['TransactionId'],
                'subtotal'          => 57000,
                'fee'               => $cek['Data']['Fee'],
                'total'             => $cek['Data']['Amount'],
                'batas_bayar'       => $cek['Data']['ExpiredDate'],
                'via'               => $method_,
                'channel'           => $cek['Data']['PaymentChannel'],
                'payment_number'    => $cek['Data']['PaymentCode'],
                'payment_name'      => $cek['Data']['PaymentName'],
                'status_desc'       => $cek['Data']['StatusDesc'],
                'status_pembayaran' => $cek['Data']['PaidStatus'],
            ]);

            // ke sistem lama
            $url_sistem_lama = 'https://admin.entrepreneurid.org/api/transaction/create';
            $apiKey_sistem_lama = '09619678a1403be5dcab79c793f3fa0f';

            $data_ke_sistem_lama = [
                'id_event'  => 79,
                'id_agen'   => 100001,
                'nama'      => 'John Doe',
                'email'     => 'john@example.com',
                'kode_nohp' => '62',
                'nohp'      => '8123456789',
                'panggilan' => 'John',
                'domisili'  => 'Jakarta',
                'tgllahir'  => '1990-01-01',
                'gender'    => '1',
                'kodeunik'  => 123,
                'total'     => 10000,
            ];

            $response_sistem_lama = Http::withHeaders([
                'api_key' => $apiKey_sistem_lama,
                'Content-Type' => 'application/json',
            ])->post($url_sistem_lama, $data_ke_sistem_lama);

            $get_sistem_lama = $response_sistem_lama->json();

            $simpan->invoice_id     = date('Ymd') . $simpan->id;
            $simpan->sistem_lama_id = $get_sistem_lama['data']['id'];
            $simpan->save();


            return 'berhasil';
        } else {
            return $status_api;
        }
    }

    public function invoice($uuid)
    {
        $transaction = Transaction::where('uuid', $uuid)->first();
        if ($transaction) {
            return view('pages.invoice', compact('transaction'));
        } else {
            return redirect()->route('dashboard');
        }
    }
    public function transaksi()
    {
        // $va           = '1179001364818964'; //get on iPaymu dashboard
        // $apiKey       = '516A6C4F-D5F7-4D3B-AC26-18FFFEEF3B87'; //get on iPaymu dashboard

        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode

        $method       = 'POST'; //method

        //Request Body//
        $body    = [
            'product'        => ['Pemesanan Kelas Profit 10 Juta'],
            'qty'            => ['1'],
            'price'          => ['57000'],
            'amount'         => '57000',
            'returnUrl'      => 'https://kelasentrepreneurid.com/pemesanan/selesai',
            'cancelUrl'      => 'https://kelasentrepreneurid.com/pemesanan/cancel',
            'notifyUrl'      => 'https://kelasentrepreneurid.com/pemesanan/callback',
            'referenceId'    => Str::uuid(),
            'comments'       => 'Payment to XYZ',
            'paymentMethod'  => 'qris',
            'paymentChannel' => 'qris',
            'feeDirection'   => 'BUYER',
            'expired'        => '24',                                                    //your reference id
            // 'buyerName'      => auth()->user()->name,
            // 'buyerEmail'     => auth()->user()->email,
            // 'buyerPhone'     => auth()->user()->phone_code . auth()->user()->phone_number,
            'name'      => auth()->user()->name,
            'email'     => auth()->user()->email,
            'phone'     => auth()->user()->phone_code . auth()->user()->phone_number,
        ];
        //End Request Body//

        //Generate Signature
        // *Don't change this
        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature    = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp    = Date('YmdHis');
        //End Generate Signature

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'va' => $va,
            'signature' => $signature,
            'timestamp' => $timestamp,
        ])->post($url, $body);

        if ($response->failed()) {
            return response()->json($response->json());
        }

        $ret = $response->json();
        if ($ret['Status'] == 200) {
            $transactionId = $ret['Data']['TransactionId'];
            return redirect()->route('transaksi.pembayaran',
                        [
                        'signature' => $signature,
                        'transactionId' => $transactionId,
                        'timestamp' => $timestamp,
                        ]);

        } else {
            return response()->json($ret);
        }
    }

    function pembayaran()
    {
        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode

        $method       = 'POST'; //method

        $body    = [
            'transactionId' => 138557,
            'account' => $va
        ];

        $jsonBody     = json_encode($body, JSON_UNESCAPED_SLASHES);
        $requestBody  = strtolower(hash('sha256', $jsonBody));
        $stringToSign = strtoupper($method) . ':' . $va . ':' . $requestBody . ':' . $apiKey;
        $signature_    = hash_hmac('sha256', $stringToSign, $apiKey);
        $timestamp_    = Date('YmdHis');

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'signature' => $signature_,
            'va' => $va,
            'timestamp' => $timestamp_,
        ])->post('https://sandbox.ipaymu.com/api/v2/transaction', [
            'transactionId' => 138557,
            'account' => $va
        ]);

        $ret = $response->json();
        return response()->json($ret);

    }
}
