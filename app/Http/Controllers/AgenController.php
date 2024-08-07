<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\Agen;
use ProtoneMedia\Splade\SpladeTable;
use App\Tables\PesertaAgen;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Peserta;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
USE App\Models\TransactionHQ;
use Throwable;

class AgenController extends Controller
{

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

    public function agen_plus() {
        return view('agen.plus.index');
    }

    public function agen_plus_kelas($kelas) {
        $peserta = PesertaAgen::class;
        return view('agen.plus.kelas', compact('peserta', 'kelas'));
    }

    public function agen_plus_create() {
        return view('agen.plus.kelas-create');
    }

    public function agen_plus_kelas_store(Request $request) {
            $request->validate([
                'name'           => ['required', 'string', 'max:255'],
                'email'          => ['required', 'string', 'email', 'max:255'],
                'phone_number'   => ['required', 'string', 'max:15'],
                'phone_code'     => ['max:6'],
                'password'       => ['required', 'min:6'],
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

                // try {
                //     $transaksi_hq = new TransactionHQ;
                //     $transaksi_hq->uuid        = Str::uuid();
                //     $transaksi_hq->nama        = $user->name;
                //     $transaksi_hq->email       = $user->email;
                //     $transaksi_hq->panggilan   = $user->name;
                //     $transaksi_hq->kode_nohp   = $user->phone_code ?? 62;
                //     $transaksi_hq->nohp        = $user->phone_number;
                //     $transaksi_hq->gender      = null;
                //     $transaksi_hq->tgllahir    = null;
                //     $transaksi_hq->id_agen     = auth()->user()->id ?? 100001;
                //     $transaksi_hq->id_event    = 79;
                //     $transaksi_hq->total       = 123000;
                //     $transaksi_hq->status      = 3;
                //     $transaksi_hq->jenis       = 1;
                //     $transaksi_hq->save();
                // } catch (\Exception $e) {
                //     // jika terjadi error maka tidak perlu dilanjutkan
                // } finally {
                //     // Menambahkan waktu timeout jika perlu
                //     Http::timeout(60);
                // }

                $peserta = Peserta::create([
                    'user_id' => $user->id,
                    'kelas_id'=> 1,
                    'agen_id' => auth()->user()->id,
                ]);


                $isiwa = '*UPDATE AKSES KELAS PROFIT 10 JUTA*

Halo '.$user->name.',

Sekali lagi selamat sudah terdaftar sebagai peserta di Kelas Profit 10 Juta.

Lewat pesan ini kami ingin memberitahu cara baru mengaskes kelas yang Anda ikuti ya.

Caranya :
Klik https://kelasentrepreneurID.com/login

Lalu masuk dengan akun ini
Email : '.$user->email.'
Password : '.$user->show_password.'

Silahkan dicoba ya.

Jika ada kendala dalam mengakses kelasnya, silahkan balas pesan ini.
Terimakasih. 😊

Salam,

*Tim entrepreneurID*

Nb : Jika Anda mengalami kendala saat mengakses materinya, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $this->notifwa($user->phone_code . $user->phone_number, $isiwa);

                Toast::title('Berhasil Ditambahkan !')->autoDismiss(5);
                return redirect()->back();
            } else {
                $peserta = null;
                if ($user->email != 'admin@kelasentrepreneurid.com'  || $user->phone_number != '8125144744' ) {
                    // try {
                    //     $transaksi_hq = new TransactionHQ;
                    //     $transaksi_hq->uuid        = Str::uuid();
                    //     $transaksi_hq->nama        = $user->name;
                    //     $transaksi_hq->email       = $user->email;
                    //     $transaksi_hq->panggilan   = $user->name;
                    //     $transaksi_hq->kode_nohp   = $user->phone_code ?? 62;
                    //     $transaksi_hq->nohp        = $user->phone_number;
                    //     $transaksi_hq->gender      = null;
                    //     $transaksi_hq->tgllahir    = null;
                    //     $transaksi_hq->id_agen     = auth()->user()->id ?? 100001;
                    //     $transaksi_hq->id_event    = 79;
                    //     $transaksi_hq->total       = 123000;
                    //     $transaksi_hq->status      = 3;
                    //     $transaksi_hq->jenis       = 1;
                    //     $transaksi_hq->save();
                    // } catch (\Exception $e) {
                    //     // jika terjadi error maka tidak perlu dilanjutkan
                    // } finally {
                    //     // Menambahkan waktu timeout jika perlu
                    //     Http::timeout(60);
                    // }
                    $cekpeserta = Peserta::where('user_id',$user->id)->first();
                    if (!$cekpeserta) {
                        $peserta = Peserta::create([
                            'user_id' => $user->id,
                            'kelas_id'=> 1,
                            'agen_id' => auth()->user()->id,
                        ]);
                    }
                }

                $isiwa = '*UPDATE AKSES KELAS PROFIT 10 JUTA*

Halo '.$user->name.',

Sekali lagi selamat sudah terdaftar sebagai peserta di Kelas Profit 10 Juta.

Lewat pesan ini kami ingin memberitahu cara baru mengaskes kelas yang Anda ikuti ya.

Caranya :
Klik https://kelasentrepreneurID.com/login

Lalu masuk dengan akun ini
Email : '.$user->email.'
Password : '.$user->show_password.'

Silahkan dicoba ya.

Jika ada kendala dalam mengakses kelasnya, silahkan balas pesan ini.
Terimakasih. 😊

Salam,

*Tim entrepreneurID*

Nb : Jika Anda mengalami kendala saat mengakses materinya, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $this->notifwa($user->phone_code . $user->phone_number, $isiwa);

                Toast::title('User Terdaftar. Berhasil Ditambahkan Di Kelas')->autoDismiss(5);
                return redirect()->back();
            }
    }

    public function agen_plus_kelas_peserta($kelas, $id) {

        $peserta = User::find($id);
        return view('agen.plus.peserta', compact('id', 'peserta', 'kelas'));
    }

    public function agen_plus_kelas_peserta_update(Request $request) {
        $request->validate([
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255'],
            'phone_number'   => ['required', 'string', 'max:15'],
            'phone_code'     => ['max:6'],
        ]);

        // Menghapus karakter '0' di awal nomor telepon yang dimasukkan oleh pengguna
        $phone_number = ltrim($request->phone_number, '0');

        // Cek apakah user sudah ada di database
        $user = User::where('email', $request->email)
                    ->orWhere('phone_number', $phone_number)
                    ->first();

        if ($user) {
            $user->update([
                'name'         => strtolower($request->name),
                'email'        => strtolower($request->email),
                'phone_code'   => $request->phone_code ?? '62',
                'phone_number' => $phone_number,
                'show_password'=> $request->show_password,
                'password'     => Hash::make($request->show_password),
            ]);
            Toast::title('Berhasil Diperbaruhi !')->autoDismiss(5);
            return redirect()->back();
        } else {
            Toast::warning('Terjadi Kesalahan !')->autoDismiss(5);
            return redirect()->back();
        }

    }
}
