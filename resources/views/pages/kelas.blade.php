@extends('layouts.dashboard')
@section('content')
<section>
    <div class="py-6">
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 lg:grid-cols-3 gap-3 md:gap-6">
            <div class="flex flex-col border justify-center bg-white rounded-xl">
                <img class="max-w-md p-6 sm:p-8" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                <div class="p-3 md:p-6 text-center">
                    <small class="text-gray-900 text-xs hidden md:block">new</small>
                    <h1 class="text-md sm:text-2xl font-semibold text-gray-700 pb-2">Kelas PROFIT 10 JUTA</h1>
                    {{-- <p class="text-sm sm:text text-gray-500 leading-6">Kelas Online mindset usaha</p> --}}
                    <h1 class="text-xl sm:text-2xl font-semibold text-gray-900 pb-2">Rp 57.000</h1>

                    <div class="pb-4 mt-4">
                        <a href="#" title=""
                            class="flex items-center justify-center py-1.5 md:py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                            role="button">
                            Masuk
                        </a>

                        <Link href="{{ route('pemesanan') }}" title=""
                            class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-1.5 md:py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                            role="button">

                            Pesan
                        </Link>
                    </div>
                </div>
            </div>

        </div>

      </div>

    </div>
  </section>

@endsection
