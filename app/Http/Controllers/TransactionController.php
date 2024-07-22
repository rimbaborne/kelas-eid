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
use ProtoneMedia\Splade\Facades\Toast;

use ProtoneMedia\Splade\Facades\SEO;
USE App\Models\TransactionHQ;
use Throwable;
use Illuminate\Support\Facades\Mail;
use App\Mail\Pemesanan;
use App\Mail\PemesananSelesai;


class TransactionController extends Controller
{
    public $description, $keywords, $sitename;
    public function __construct()
    {
        $this->description = 'Menawarkan materi yang lengkap, mentor berpengalaman, dan komunitas belajar yang suportif untuk membantu Anda mencapai tujuan bisnis Anda.';
        $this->keywords = 'Belajar Bisnis Online, entrepreneurID, Bisnis,';
        $this->sitename = 'Kelas entrepreneurID';
    }

    public function notifwa($nomorhp, $isipesan)
    {
        $datawa = json_decode($isipesan);

        $apikey     = env('WAHA_API_KEY');
        $url        = env('WAHA_API_URL');
        $sessionApi = env('WAHA_API_SESSION');
        $requestApi = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept'       => 'application/json',
            'X-Api-Key'    => $apikey,
        ]);

        try {
            #1 Send Seen
            $requestApi->post($url.'/api/sendSeen', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #2 Start Typing
            $requestApi->post($url.'/api/startTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            sleep(1); // jeda seolah olah ngetik

            #3 Stop Typing
            $requestApi->post($url.'/api/stopTyping', [ "session" => $sessionApi, "chatId"  => $nomorhp.'@c.us', ]);

            #4 Send Message
            $requestApi->post($url.'/api/sendText', [
                "session" => $sessionApi,
                "chatId"  => $nomorhp.'@c.us',
                "text"    => $isipesan,
            ]);
        } catch (Throwable $th) {
            throw $th;
        }
    }

    public function pemesanan_kelasprofit(Request $request)
    {
        $agen = $request->ref ?? 100001;
        $page_title = 'Kelas entrepreneurID | Kelas Profit 10 Juta';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('kelasentrepreneurid.or.id')
            ->openGraphImage(asset('/assets/img/logo-eid-merah.png'))
            ;

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
                }
            }
        }
        return view('pages.pemesanan', compact('agen'));
    }
    public function pemesanan_kelasprofit_store($agen, Request $request)
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
                    'name'         => strtolower($request->name),
                    'email'        => strtolower($request->email),
                    'phone_code'   => $request->phone_code ?? '62',
                    'phone_number' => $phone_number,
                    'show_password'=> $request->password,
                    'password'     => Hash::make($request->password),
                ]);
            }
        } else {
            $request->validate([
                'payment_method' => ['required'],
            ]);
            $user = Auth::user();
        }

        $transaction_check = Transaction::where('user_id', $user->id)
                                        ->where('kelas_id', 1)
                                        ->first();
        if ($transaction_check) {
            if ($transaction_check->status_pembayaran == 'paid') {
                Toast::title('Akun Anda sudah memiliki kelas ini, silahkan login.');
                return redirect()->route('kelas.profit.1');
            } elseif ($transaction_check->status_pembayaran == 'unpaid' && $transaction_check->batas_bayar >= now()) {
                Toast::title('Akun Anda sudah memesan kelas ini, silahkan lanjutkan pembayarannya.');
                return redirect()->route('pemesanan.invoice', [ 'uuid' => $transaction_check->uuid]);
            }
        }

        // Kode ini memicu event Registered setelah pengguna baru berhasil didaftarkan.
        // event(new Registered($user));

        // Auth::login($user);


        $va           = '1179001364818964'; //get on iPaymu dashboard
        $apiKey       = '516A6C4F-D5F7-4D3B-AC26-18FFFEEF3B87'; //get on iPaymu dashboard

        // $va           = '0000008125144744'; //get on iPaymu dashboard
        // $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        // $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; // for development mode
        $url          = 'https://my.ipaymu.com/api/v2/payment/direct'; // for production mode

        $method       = 'POST'; //method

        if ($request->payment_method == 'qris') {
            $method_ = 'qris';
            $channel_ = 'mpm';
        } else {
            $method_ = 'va';
            $channel_ = $request->payment_method;
        }

        $ref_id = Str::uuid();
        if ($request->payment_method == 'qris') {
            $expired = '24';
        } elseif ($request->payment_method == 'bsi') {
            $expired = '3';
        } elseif ($request->payment_method == 'br') {
            $expired = '2';
        } elseif ($request->payment_method == 'bca') {
            $expired = '12';
        } else {
            $expired = '3';
        }

        //Request Body//
        $body    = [
            'product'        => ['Kelas Profit 10 Juta'],
            'qty'            => ['1'],
            'price'          => ['57000'],
            'amount'         => '57000',
            'returnUrl'      => 'https://kelasentrepreneurid.com/transaksi/selesai',
            'cancelUrl'      => 'https://kelasentrepreneurid.com/transaksi/cancel',
            'notifyUrl'      => 'https://kelasentrepreneurid.com/transaksi/callback',
            'referenceId'    => $ref_id,
            'paymentMethod'  => $method_,
            'paymentChannel' => $channel_,
            'feeDirection'   => 'BUYER',
            'expired'        => $expired,
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
            $payment_number_ = $method_ == 'qris' ? 'QRIS' : $status_api['Data']['PaymentNo'];
            $simpan = Transaction::create([
                'uuid'              => $status_api['Data']['SessionId'],
                'user_id'           => $user->id,
                'kelas_id'          => 1,
                'agen_id'           => $agen ?? 100001,
                'id_ipaymu'         => $status_api['Data']['TransactionId'],
                'subtotal'          => 57000,
                'fee'               => $status_api['Data']['Fee'],
                'total'             => $status_api['Data']['Fee']+$status_api['Data']['Total'],
                'batas_bayar'       => $status_api['Data']['Expired'],
                'via'               => $method_,
                'channel'           => $status_api['Data']['Channel'],
                'payment_number'    => $payment_number_,
                'payment_name'      => $status_api['Data']['PaymentName'],
                'status_desc'       => 'Menunggu Pembayaran',
                'status_pembayaran' => 'unpaid',
                'qris_string'       => $status_api['Data']['QrString'] ?? null,
                'qris_nmid'         => $status_api['Data']['NMID'] ?? null,
            ]);
            // try {
            //     $transaksi_hq = new TransactionHQ;
            //     $transaksi_hq->uuid        = $ref_id;
            //     $transaksi_hq->nama        = $user->name;
            //     $transaksi_hq->email       = $user->email;
            //     $transaksi_hq->panggilan   = $user->name;;
            //     $transaksi_hq->kode_nohp   = $user->phone_code ?? 62;
            //     $transaksi_hq->nohp        = $user->phone_number;
            //     $transaksi_hq->gender      = null;
            //     $transaksi_hq->tgllahir    = null;
            //     $transaksi_hq->id_agen     = $request->agen ?? 100001;
            //     $transaksi_hq->id_event    = 79;
            //     $transaksi_hq->total       = 57000;
            //     $transaksi_hq->status      = 1;
            //     $transaksi_hq->jenis       = 1;
            //     $transaksi_hq->save();
            // } catch (\Exception $e) {
            //     // jika terjadi error maka tidak perlu dilanjutkan
            // }

            $simpan->invoice_id     = date('Ymd') . $simpan->id;
            $simpan->sistem_lama_id = null;
            $simpan->save();

            $isiwa = 'Halo '.$user->name.',

Segera selesaikan pendaftaran Kelas Profit 10 Juta Anda dengan cara transfer sebesar Rp '.number_format($simpan->total, 0, ',', '.').'
di link berikut : '.route('pemesanan.invoice', ['uuid' => $ref_id]).'

Masa berlaku invoice ini hanya sampai '.$simpan->batas_bayar.'

Salam,

Tim entrepreneurID

Nb : Jika Anda ada pertanyaan, silahkan balas chat ini. 🙂';

            $this->notifwa($user->phone_code . $user->phone_number, $isiwa);

            $isiemail = 'Dear '.$user->name.', <br><br>

Segera selesaikan pendaftaran Kelas Profit 10 Juta Anda dengan cara transfer sebesar Rp '.number_format($simpan->total, 0, ',', '.').'<br>
di link berikut : '.route('pemesanan.invoice', ['uuid' => $ref_id]).'<br><br>

Masa berlaku invoice ini hanya sampai '.$simpan->batas_bayar.'<br><br>

Salam,<br><br>

Tim entrepreneurID <br><br>

Nb : Jika Anda ada pertanyaan, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $data = [
                'subject'  => '[Invoice Pendaftaran Kelas 10 Juta]',
                'isi' => $isiemail,
            ];

            Mail::to($user->email)->send(new Pemesanan($data));

            return redirect()->route('pemesanan.invoice', ['uuid' => $ref_id]);
        } else {
            return $status_api;
        }
    }
    public function invoice($uuid)
    {
        $page_title = 'invoice | Kelas Profit 10 Juta';
        SEO::title($page_title)
            ->description($this->description)
            ->keywords($this->keywords)
            ->openGraphType('WebPage')
            ->openGraphSiteName($page_title)
            ->openGraphTitle($page_title)
            ->openGraphUrl('kelasentrepreneurid.or.id')
            ->openGraphImage(asset('/assets/img/logo-eid-merah.png'))
            ;

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
            'notifyUrl'      => 'https://kelasentrepreneurid.com/transaksi/callback',
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
    public function pembayaran()
    {
        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        $url          = 'https://sandbox.ipaymu.com/api/v2/payment/direct'; // for development mode
        // $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode

        $method       = 'POST'; //method

        $body    = [
            'transactionId' => 138719,
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
            'transactionId' => 138719,
            'account' => $va
        ]);

        $ret = $response->json();
        return response()->json($ret);

    }
    public function callback(Request $request){

        $trx_id       = $request->trx_id;
        $status       = $request->status;
        $status_code  = $request->status_code;
        $sid          = $request->sid;

        $transaction  = Transaction::where('id_ipaymu', $trx_id)->first();
        $user         = User::find($transaction->user_id);

        if ($request->status == 'berhasil') {
            $transaction->update([
                'status_pembayaran_code' => $status_code,
                'status_pembayaran'      => 'paid',
                'status_desc'            => 'Pembayaran Berhasil',
                'berhasil_bayar'         => now(),
            ]);

            $isiwa = 'Halo '.$user->name.',

Selamat telah menjadi peserta di Kelas Profit 10 Juta. 😇
Silahkan akses materinya disini https://kelasentrepreneurid.com/login

Masuk dengan akun Anda
Email : '.$user->email.'
Password : '.$user->show_password.'

Selain akses materi diatas, Anda juga bisa dapat bimbingan via WA dan dapat update materi kursus ini dengan cara
👇👇👇
Chat nomor WA 082318989848
Dengan format : Peserta KPS eID
Atau kalau mau lebih cepat, bisa klik link ini https://wa.me/6282318989848?text=Peserta%20KPS%20eID

Sekali lagi selamat belajar.
Semoga ini jadi wasilah untuk pertumbuhan bisnis Anda, aamiin. 🤲

Salam,

Tim entrepreneurID

Nb : Jika Anda mengalami kendala saat mengakses materinya, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $this->notifwa($user->phone_code . $user->phone_number, $isiwa);

            $isiemail = 'Dear '.$user->name.', <br><br>

Selamat telah menjadi peserta di Kelas Profit 10 Juta. 😇 <br>
Silahkan akses materinya disini https://kelasentrepreneurid.com/login <br><br>

Masuk dengan akun Anda <br>
Email : '.$user->email.'<br>
Password : '.$user->show_password.'<br><br>

Selain akses materi diatas, Anda juga bisa dapat bimbingan via WA dan dapat update materi kursus ini dengan cara <br>
👇👇👇<br>
Chat nomor WA 082318989848<br>
Dengan format : Peserta KPS eID<br>
Atau kalau mau lebih cepat, bisa klik link ini https://wa.me/6282318989848?text=Peserta%20KPS%20eID <br><br>

Salam,<br><br>

Tim entrepreneurID <br><br>

Nb : Jika Anda ada pertanyaan, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $data = [
                'subject'  => '[Akses Kelas Profit 10 Juta Anda]',
                'isi' => $isiemail,
            ];

            Mail::to($user->email)->send(new Pemesanan($data));

            return response()->json(['message' => 'Transaksi berhasil diterima.'], 200);
        } else {

            $transaction->update([
                'status_pembayaran_code' => $status_code,
                'status_pembayaran'      => $status,
            ]);
            return response()->json(['message' => 'Transaksi tidak berhasil.'], 404);
        }
    }

    public function cancel() {
        return view('pages.cancel');
    }

    public function selesai() {
        return view('pages.selesai');
    }
}
