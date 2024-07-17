@extends('layouts.dashboard')
@section('content')
    <div class="flow-root pb-6">
        <div class="mx-auto">
            {{-- Halo, --}}
        </div>
        <section class="text-gray-600 body-font">
            <div class="container px-5 py-5 mx-auto border border-gray-200 rounded-lg">
              <div class="lg:w-2/3 flex flex-col sm:flex-row sm:items-center items-start mx-auto">
                <h1 class="flex-grow sm:pr-16 text-xl font-medium title-font text-gray-900">Cek program kelas dari entrepreneurID.</h1>
                <Link href="{{ route('kelas') }}" class="flex items-center text-white bg-primary-500 border-0 py-2 px-4 focus:outline-none hover:bg-primary-600 rounded-lg text-lg mt-2 sm:mt-0">
                    Cek <x-carbon-arrow-right class="pl-4 w-10 h-10" />
                </Link>
              </div>
            </div>
          </section>
    </div>

    {{-- @if (!session('modal_shown') || now()->diffInHours(session('modal_shown')) >= 1) --}}
        <x-splade-modal opened>
            <div class="flex flex-col border justify-center bg-white rounded-xl items-center">
                <img class="h-64 p-4" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                <div class="p-3 md:p-6 text-center">
                    <h1 class="text-xl sm:text-2xl font-semibold text-gray-700 pb-2 ">Kelas Profit 10 Juta</h1>
                    <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 pb-2 ">Rp 57.000</h1>

                    <div class="gap-4 pb-2 items-center justify-center flex">

                        <a href="{{ route('pemesanan') }}" target="_blank"
                            class="text-white mt-2 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-1.5 md:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                            >
                            Pesan
                        </a>
                    </div>
                </div>
            </div>
        </x-splade-modal>
        {{-- {{ session(['modal_shown' => now()]) }} --}}
    @endif
@endsection
