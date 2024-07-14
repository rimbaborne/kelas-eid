@extends('layouts.dashboard')
@section('content')
    <div class="mt-2 sm:mt-2 md:gap-6 lg:flex lg:items-start xl:gap-8">
        <h1 class="text-2xl font-bold mb-4">Kelas Yang Terdaftar</h1>
        <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-4xl">
            <div class="space-y-4">
                <div
                    class="rounded-lg border border-gray-200 bg-white p-2 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-4">
                    <div class="space-y-2 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                        <a href="#" class="shrink-0 md:order-1">
                            <img class="w-32 p-2 sm:p-3" src="https://dashboard.agen-entrepreneurid.com/img/produk/WMH-2024-3.png">
                        </a>

                        <div class="w-full min-w-0 flex-1 space-y-2 md:order-2 md:max-w-md">
                            <Link href="#" class="text-xl font-semibold text-gray-900 hover:underline dark:text-white">
                                Kelas Profit 10 Juta
                            </Link>

                            <div class="flex items-center gap-4">
                                <Link href="{{ route('kelas') }}" class="flex items-center text-white bg-primary-700 border-0 px-4 focus:outline-none hover:bg-primary-400 rounded-lg text-sm">
                                    Masuk Kelas <x-carbon-classification class="pl-4 w-8 h-8" />
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
