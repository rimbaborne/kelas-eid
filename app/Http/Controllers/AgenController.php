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
                $peserta = Peserta::create([
                    'user_id' => $user->id,
                    'kelas_id' => 1,
                    'agen_id' => auth()->user()->agen->id,
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

*Tim entrepreneurID*

Nb : Jika Anda mengalami kendala saat mengakses materinya, silahkan hubungi Customer Support kami di link ini ➡️ bit.ly/CS-eID';

            $this->notifwa($user->phone_code . $user->phone_number, $isiwa);

                Toast::title('Berhasil Ditambahkan !')->autoDismiss(5);
                return response()->json('Berhasil Di Tambahkan '. $peserta);
            } else {
                Toast::danger('Terjadi Kesalahan. Email/No WA Sudah Terdata')->autoDismiss(5);
                return response()->json($request);
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
