<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tables\AdministrasiTransaksi;
use App\Tables\AdministrasiPeserta;
use App\Models\Peserta;
use App\Models\User;
use ProtoneMedia\Splade\Facades\Toast;
use App\Models\Transaction;
use Illuminate\Support\Facades\Hash;
use App\Tables\AdministrasiUser;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;


class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function transaksi(){
        $transaksi = AdministrasiTransaksi::class;
        return view('admin.transaksi', compact('transaksi'));
    }

    public function transaksi_show($id){
        $transaction = Transaction::find($id);
        return view('admin.transaksi-show', compact('transaction'));
    }

    public function peserta(){
        $peserta = AdministrasiPeserta::class;
        return view('admin.peserta', compact('peserta'));
    }

    public function peserta_show($id){
        $peserta = User::find($id);
        return view('admin.peserta-show', compact('peserta'));
    }

    public function peserta_update($id, Request $request){
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

    public function user(){
        $user = AdministrasiUser::class;
        return view('admin.user', compact('user'));
    }

    public function user_show($id){
        $user = User::find($id);
        $roles = Role::all();

        $role[] = null;
        foreach($roles as $role_d) {
            if($user->roles->contains($role_d->id)) {
                $role[] = $role_d->id;
            }
    }
        return view('admin.user-show', compact('user', 'roles', 'role'));
    }

    public function user_update($id, Request $request){
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
                'show_password'=> $request->password,
                'password'     => Hash::make($request->password),
            ]);

            if (is_array($request->role)) {
                $roles = Role::whereIn('id', $request->role)->get();
                $user->syncRoles($roles);
            } elseif ($request->role != 0) {
                $role = Role::find($request->role);
                $user->assignRole($role->name);
            }
            Toast::title('Berhasil Diperbaruhi !')->autoDismiss(5);
            return redirect()->back();
        } else {
            Toast::warning('Terjadi Kesalahan !')->autoDismiss(5);
            return redirect()->back();
        }
    }
}
