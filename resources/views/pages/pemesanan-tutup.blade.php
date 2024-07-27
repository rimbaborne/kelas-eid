@extends('website.layouts.pembayaran')

@section('content')
    <div class="text-center py-8 bg-gray-100">
        <p class="text-sm text-gray-600">
            <Link href="{{ url('/') }}" class="text-md text-gray-600 hover:text-gray-900">
                &larr; Kembali
            </Link>
        </p>
    </div>

    <x-auth-card>
        <h1 class="text-2xl font-bold text-center py-4">Pemesanan Belum Dibuka</h1>
        <div class="flex flex-col border justify-center bg-white rounded-xl items-center mb-4">
            <div class="rounded-lg bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                    <a href="#" class="shrink-0">
                        <img class="w-28 p-2 sm:p-3" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                    </a>

                    <div class="w-full min-w-0 flex-1 space-y-2 md:max-w-md">
                        <h1 class="text-xl font-semibold text-gray-900 hover:underline dark:text-white">
                            Kelas Profit 10 Juta
                        </h1>
                        <div class="space-y-0">
                            <h1 class="text-lg font-normal text-primary-900 hover:underline dark:text-white">
                                <strike>Rp. 123.000</strike>
                            </h1>
                            <h1 class="text-xl font-semibold text-gray-900 hover:underline dark:text-white">
                                Rp. 57.000
                            </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </x-auth-card>
@endsection
