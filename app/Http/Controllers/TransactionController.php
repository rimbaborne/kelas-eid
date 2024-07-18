<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class TransactionController extends Controller
{

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
            'amount'          => '57000',
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

    function pembayaran($signature, $transactionId, $timestamp)
    {
        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'signature' => $signature,
            'va' => $va,
            'timestamp' => $timestamp,
        ])->post('https://sandbox.ipaymu.com/api/v2/transaction', [
            'transactionId' => $transactionId,
            'account' => $va
        ]);

        $ret = $response->json();
        return response()->json($ret);

    }
}
