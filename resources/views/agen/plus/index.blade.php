@extends('layouts.dashboard')
@section('content')
    <div class="flow-root pb-6">
        <div class="mx-auto">
            {{-- Halo, --}}
        </div>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-5 mx-auto rounded-lg grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6">
                <div class="flex flex-col border items-center justify-center bg-white rounded-xl">
                    <img class="w-24 pt-10" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                    <div class="p-3 md:p-6 text-center">
                        <h1 class="text-md font-semibold text-gray-700 pb-2">Kelas Profit 10 Juta</h1>
                        {{-- <p class="text-sm sm:text text-gray-500 leading-6">Kelas Online mindset usaha</p> --}}
                        <h1 class="text-xl font-semibold text-gray-900 pb-2">Rp 123.000</h1>

                        <div class="pb-4 mt-4">

                            <Link href="{{ route('agen.plus.kelas', ['kelas' => 'kelas-profit-10-juta']) }}" title=""
                                class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-1.5 md:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                                role="button">

                                Pesan
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
