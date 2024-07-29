@extends('layouts.dashboard')
@section('content')
    <div class="flow-root pb-6">
        <div class="mx-auto">
            {{-- Halo, --}}
        </div>
        <section class="text-gray-600 body-font">
            <div class="container mx-auto border border-gray-200 rounded-lg">
              <div class="flex flex-col items-start mx-auto">
                {{-- <h1 class="flex-grow sm:pr-16 text-xl font-medium title-font text-gray-900">Halo, Selamat belajar di entrepreneurID.</h1>
                <div class="gap-4 pb-2 items-center justify-center flex">
                    <Link href="{{ route('dashboard.data') }}" target="_blank"
                        class="text-white mt-2 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-1.5 md:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800"
                        >
                        Lihat Kelas
                </Link> --}}
                {{-- </div> --}}
                <div class="flex items-center justify-center">
                    <img src="{{ url('/') }}/assets/img/w-eid.jpg" class="object-cover sm:aspect-[3/2] w-full mx-auto rounded-lg" alt="welcome">
                </div>
              </div>
            </div>
          </section>
    </div>

        {{-- <x-splade-modal opened>
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
        </x-splade-modal> --}}
        {{-- {{ session(['modal_shown' => now()]) }} --}}
@endsection
