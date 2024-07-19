<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\KelasController;
// require_once base_path('vendor/ipaymu-php-api/iPaymu/iPaymu.php');
use iPaymu\iPaymu;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('splade')->group(function () {
    // Registers routes to support the interactive components...
    Route::spladeWithVueBridge();

    // Registers routes to support password confirmation in Form and Link components...
    Route::spladePasswordConfirmation();

    // Registers routes to support Table Bulk Actions and Exports...
    Route::spladeTable();

    // Registers routes to support async File Uploads with Filepond...
    Route::spladeUploads();

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['verified'])->name('dashboard');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        Route::get('/data', function () {
            return view('pages.data');
        })->name('data');

        Route::get('/pembayaran', function () {
            return view('pages.pembayaran');
        })->name('pembayaran');

        Route::get('/pemesanan', function(){

            $va           = '1179001364818964'; //get on iPaymu dashboard
            $apiKey       = '516A6C4F-D5F7-4D3B-AC26-18FFFEEF3B87'; //get on iPaymu dashboard

            // $url          = 'https://sandbox.ipaymu.com/api/v2/payment'; // for development mode
            $url          = 'https://my.ipaymu.com/api/v2/payment'; // for production mode

            $method       = 'POST'; //method

            //Request Body//
            $body    = [
                'product'     => ['Pemesanan Kelas Profit 10 Juta'],
                'qty'         => ['1'],
                'price'       => ['57000'],
                'returnUrl'   => 'https://kelasentrepreneurid.com/pemesanan/selesai',
                'cancelUrl'   => 'https://kelasentrepreneurid.com/pemesanan/cancel',
                'notifyUrl'   => 'https://kelasentrepreneurid.com/pemesanan/callback',
                'referenceId' => 'ref_'.auth()->user()->id,                                           //your reference id
                'buyerName'   => auth()->user()->name,
                'buyerEmail'  => auth()->user()->email,
                'buyerPhone'  => auth()->user()->phone_code . auth()->user()->phone_number,
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
                $sessionId  = $ret['Data']['SessionID'];
                $url        =  $ret['Data']['Url'];
                return redirect($url);
            } else {
                return response()->json($ret);
            }
        })->name('pemesanan');

        Route::get('/pemesanan/selesai', function(){
            // return view('pages.pemesanan.selesai');
            return 'selesai';
        })->name('pemesanan.selesai');

        Route::get('/pemesanan/cancel', function(){
            return 'cancel';
        })->name('pemesanan.cancel');

        Route::post('/pemesanan/callback', function(Request $request){
        $data = $request->validate([
            'trx_id' => 'required|string',
            'status' => 'required|string',
            'status_code' => 'required|string',
            'sid' => 'required|string',
            'reference_id' => 'required|string',
        ]);

        // Cek apakah data dengan sid yang sama sudah ada
        $existingData = DB::table('callbacks')->where('sid', $data['sid'])->first();

        if ($existingData) {
            // Update data yang sudah ada
            $updateData = [
                'trx_id' => $data['trx_id'],
                'status' => $data['status'],
                'status_code' => $data['status_code'],
                'reference_id' => $data['reference_id'],
                'response' => DB::raw('response + 1'), // tambahkan kolom response untuk tahu berapa kali data diupdate
                // tambahkan parameter lain di sini jika diperlukan
            ];
            DB::table('callbacks')->where('sid', $data['sid'])->update($updateData);
        } else {
            // Simpan data baru
            $insertData = [
                'trx_id' => $data['trx_id'],
                'status' => $data['status'],
                'status_code' => $data['status_code'],
                'sid' => $data['sid'],
                'reference_id' => $data['reference_id'],
                // tambahkan parameter lain di sini jika diperlukan
            ];
            DB::table('callbacks')->insert($insertData);
        }

        return response()->json(['message' => 'Callback data has been processed successfully.'], 200);

        })->name('pemesanan.callback');
    });

    require __DIR__.'/auth.php';

    # Routing Website Utama Non Auth
    require __DIR__.'/sub/website.php';

    Route::get('/kelas', function () {
        return view('pages.kelas');
    })->name('kelas');

    // Route::get('/kelas/kelas-profit-10-juta', [ProfileController::class, 'kelas_profit'])->name('profile.kelas.profit');
    Route::get('/kelas/kelas-profit-10-juta', [KelasController::class, 'profit'])->name('kelas.profit');
    Route::get('/kelas/kelas-profit-10-juta/1', [KelasController::class, 'profit_1'])->name('kelas.profit.1');
    Route::get('/kelas/kelas-profit-10-juta/2', [KelasController::class, 'profit_2'])->name('kelas.profit.2');
    Route::get('/kelas/kelas-profit-10-juta/3', [KelasController::class, 'profit_3'])->name('kelas.profit.3');

    Route::get('/signature', function(){

        $httpMethod = 'POST';
        $vaNumber = '0000008125144744'; // Contoh VA Number
        $apiKey = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; // Contoh API Key
        $requestBody = [
            'name' => 'Putu',
            'phone' => '081999501092',
            'email' => 'putu@mail.com',
            'amount' => '2000000',
            'notifyUrl' => 'https://kelasentrepreneurid.com/callback',
            'expired' => '24',
            'comments' => 'Payment to XYZ',
            'referenceId' => '1',
            'paymentMethod' => 'qris',
            'paymentChannel' => 'qris',
            'product' => ['produk 1'],
            'qty' => ['1'],
            'price' => ['2000000'],
            'feeDirection' => 'BUYER'
        ];

        $requestBodyJson = json_encode($requestBody);
        $requestBodyHash = strtolower(hash('sha256', $requestBodyJson));
        $stringToSign = strtoupper($httpMethod) . ":$vaNumber:$requestBodyHash:$apiKey";
        $signature = hash_hmac('sha256', $stringToSign, $apiKey);

        return "Signature: " . $signature;
    })->name('signature');

    Route::get('/pemesanan/direct', function(){

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
            'referenceId'    => 'ref_'.auth()->user()->id,
            'comments'       => 'Payment to XYZ',
            'paymentMethod'  => 'va',
            'paymentChannel' => 'bni',
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
        return response()->json($ret);
    })->name('pemesanan');

    Route::get('/pemesanan/direct-payment', function () {
        $va           = '0000008125144744'; //get on iPaymu dashboard
        $apiKey       = 'SANDBOXDF3E6F1F-5E4A-44EF-9EDB-98D7BD737DAA'; //get on iPaymu dashboard
        $production   = false;

        $ipaymu = new iPaymu($apiKey, $va, $production);

        $ipaymu->setURL([
            'returnUrl'      => 'https://kelasentrepreneurid.com/pemesanan/selesai',
            'cancelUrl'      => 'https://kelasentrepreneurid.com/pemesanan/cancel',
            'notifyUrl'      => 'https://kelasentrepreneurid.com/pemesanan/callback',
        ]);

        $ipaymu->setBuyer([
            'name'      => auth()->user()->name,
            'email'     => auth()->user()->email,
            'phone'     => auth()->user()->phone_code . auth()->user()->phone_number,
        ]);

        $ipaymu->addCart([
            'product' => ['Kelas Profit 10 Juta'],
            'quantity' => [1],
            'price' => [57000],
        ]);

        //payment - direct
        $directData = [
            'amount' => 57000,
            'expired' => 24,
            'expiredType' => 'hours',
            'referenceId' => 10101011,
            'paymentMethod' => 'qris', //va, cstore
            'paymentChannel' => 'qris', //bag, mandiri, cimb, bni,

        ];

        $direct = $ipaymu->directPayment($directData);

        return $direct;
    });

    Route::get('/pemesanan/kelas-profit-10-juta', [TransactionController::class, 'pemesanan_kelasprofit'])->name('pemesanan');
    Route::post('/pemesanan/kelas-profit-10-juta/store', [TransactionController::class, 'pemesanan_kelasprofit_store'])->name('pemesanan.profit.store');
    Route::get('/pemesanan/invoice/{uuid}', [TransactionController::class, 'invoice'])->name('pemesanan.invoice');

    Route::get('/transaksi', [TransactionController::class, 'transaksi'])->name('transaksi');
    Route::get('/transaksi/pembayaran', [TransactionController::class, 'pembayaran'])->name('transaksi.pembayaran');

    Route::get('/kirim-data', function () {
        $url_sistem_lama = 'https://admin.entrepreneurid.org/api/transaction/create';
        $apiKey_sistem_lama = '09619678a1403be5dcab79c793f3fa0f';

        $data_ke_sistem_lama = [
            'id_event'  => 64,
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

        return $response_sistem_lama->json();

    });

});
