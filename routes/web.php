<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
    });

    require __DIR__.'/auth.php';

    # Routing Website Utama Non Auth
    require __DIR__.'/sub/website.php';

    Route::get('/kelas', function () {
        return view('pages.kelas');
    })->name('kelas');

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
            'price'       => ['49000'],
            'returnUrl'   => 'https://kelasentrepreneurid.com/pemesanan/selesai',
            'cancelUrl'   => 'https://kelasentrepreneurid.com/pemesanan/cancel',
            'notifyUrl'   => 'https://kelasentrepreneurid.com/pemesanan/callback',
            'referenceId' => auth()->user()->id,                                           //your reference id
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
    });

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
