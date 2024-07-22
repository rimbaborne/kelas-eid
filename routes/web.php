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
use App\Domain\Website\Controllers\WebController;
use App\Http\Middleware\VerifyCsrfToken;

Route::get("/", [WebController::class, "home"])->name("website.home");
Route::post('/transaksi/callback', [TransactionController::class, 'callback'])->name('transaksi.callback');

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
        })->name('dashboard');

        Route::get('/dashboard/data', function () {
            return view('dashboard');
        })->name('dashboard.data');

        Route::get('/dashboard/pembayaran', function () {
            return view('dashboard');
        })->name('dashboard.pembayaran');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


        Route::get('/data', function () {
            return view('pages.data');
        })->name('data');

    });

    require __DIR__.'/auth.php';

    # Routing Website Utama Non Auth
    require __DIR__.'/sub/website.php';

    Route::get('/kelas', function () {
        return view('pages.kelas');
    })->name('kelas');

    Route::get('/kelas/kelas-profit-10-juta', [KelasController::class, 'profit'])->name('kelas.profit');
    Route::get('/kelas/kelas-profit-10-juta/1', [KelasController::class, 'profit_1'])->name('kelas.profit.1');
    Route::get('/kelas/kelas-profit-10-juta/2', [KelasController::class, 'profit_2'])->name('kelas.profit.2');
    Route::get('/kelas/kelas-profit-10-juta/3', [KelasController::class, 'profit_3'])->name('kelas.profit.3');


    Route::get('/pemesanan/kelas-profit-10-juta/', [TransactionController::class, 'pemesanan_kelasprofit'])->name('pemesanan');
    Route::post('/pemesanan/kelas-profit-10-juta/store/{agen}', [TransactionController::class, 'pemesanan_kelasprofit_store'])->name('pemesanan.profit.store');
    Route::get('/pemesanan/invoice/{uuid}', [TransactionController::class, 'invoice'])->name('pemesanan.invoice');
    Route::get('/pemesanan/cek', [TransactionController::class, 'pembayaran'])->name('pemesanan.cek');

    Route::get('/transaksi', [TransactionController::class, 'transaksi'])->name('transaksi');
    Route::get('/transaksi/pembayaran', [TransactionController::class, 'pembayaran'])->name('transaksi.pembayaran');
    Route::get('/transaksi/cancel', [TransactionController::class, 'cancel'])->name('transaksi.cancel');
    Route::get('/transaksi/selesai', [TransactionController::class, 'selesai'])->name('transaksi.selesai');



});
