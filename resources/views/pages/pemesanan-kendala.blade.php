@extends('website.layouts.pembayaran')

@section('content')
    <x-auth-card>
        <div class="flex flex-col justify-center bg-white rounded-xl items-center mb-4">
            <div class="rounded-lg bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                    <div class="w-full min-w-0 flex-1 space-y-2 md:max-w-md text-center">
                        <h1 class="text-sm  text-gray-600 hover:underline dark:text-white mb-4">
                            Mohon maaf terjadi beberapa kesalahan, silahkan coba daftar lagi dalam beberapa menit, atau bisa langsung hubungi tim CS kami di WA <a hres="wa.me/085787572580" target="_blank">085787572580</a>
                        </h1>
                        <a href="{{ url('/') }}/pemesanan/kelas-profit-10-juta/?ref={{ request()->ref ?? 100001 }}" class="mt-4 py-2.5 px-5 rounded-md bg-primary-500 hover:bg-primary-700 text-white"
                            type="button">
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </x-auth-card>
@endsection
