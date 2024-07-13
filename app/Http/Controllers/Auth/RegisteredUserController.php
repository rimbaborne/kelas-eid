<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:15', 'unique:'.User::class],
            'phone_code'   => ['max:6'],
              // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'password'     => ['required', 'min:6'],
        ]);

        // Menghapus karakter '0' di awal nomor telepon yang dimasukkan oleh pengguna
        $phone_number = ltrim($request->phone_number, '0');

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone_code'   => $request->phone_code ?? '62',
            'phone_number' => $phone_number,
            'password'     => Hash::make($request->password),
        ]);

        // Kode ini memicu event Registered setelah pengguna baru berhasil didaftarkan.
        event(new Registered($user));

        Auth::login($user);

        return redirect('/dashboard');
    }
}
