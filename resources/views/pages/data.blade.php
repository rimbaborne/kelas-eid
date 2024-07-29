@extends('layouts.dashboard')
@section('content')
    <div class="mt-2 sm:mt-2 md:gap-6 xl:gap-8">
        <div class="mx-auto container">
            <h1 class="text-2xl font-bold mb-4">Kelas Yang Terdaftar</h1>
        </div>


        <div class="mx-auto w-full flex-none max-w-2xl xl:max-w-4xl">
            <div class="space-y-4">
                @if ($data)
                    <div class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                        <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                            <a href="#" class="shrink-0">
                                <img class="w-32 p-2 sm:p-3" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                            </a>

                            <div class="w-full min-w-0 flex-1 space-y-2 md:max-w-md">
                                <div class="text-xl font-semibold text-gray-900 hover:underline dark:text-white">
                                    Kelas Profit 10 Juta
                                </div>

                                <div class="flex items-center gap-4">
                                    <a href="{{ route('kelas.profit.video', ['link' => 1]) }}/" class="flex items-center text-white bg-primary-700 border-0 px-4 focus:outline-none hover:bg-primary-400 rounded-lg text-sm">
                                        Masuk Kelas <x-carbon-classification class="pl-4 w-8 h-8" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                <div class="flex items-start justify-center">
                    <h4 class="text-lg text-gray-400">Anda belum memiliki kelas</h4>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection
