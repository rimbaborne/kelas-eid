@extends('layouts.dashboard')
@section('content')
    <div class="mt-2 sm:mt-2 md:gap-6 xl:gap-8">
        <div class="mx-auto container">
            <h1 class="text-2xl font-bold mb-4">Riwayat Pembayaran</h1>
        </div>
        @if ($data)
            <div class="mx-auto w-full flex-none max-w-2xl xl:max-w-4xl">
                <div class="space-y-4">
                    {{-- <div class="gap-4 lg:flex lg:items-center lg:justify-between">
                        <div></div>
                        <div class="mt-6 gap-4 space-y-4 sm:flex sm:items-center sm:space-y-0 lg:mt-0 lg:justify-end">
                        <div>
                            <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select order type</label>
                            <select id="order-type" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 sm:w-[144px]">
                            <option selected>All orders</option>
                            <option value="ongoing">Ongoing</option>
                            <option value="completed">Completed</option>
                            <option value="denied">Denied</option>
                            </select>
                        </div>

                        <button type="button" class="w-full rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300   dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 sm:w-auto">Add return request</button>
                        </div>
                    </div> --}}

                    <div class="mt-6 flow-root sm:mt-8">
                        <div class="divide-y divide-gray-200 dark:divide-gray-700">
                            <div class="relative grid grid-cols-2 gap-4 py-6 sm:grid-cols-4 lg:grid-cols-5">
                                <div class="col-span-2 content-center sm:col-span-4 lg:col-span-1">
                                    <a href="{{ route('pemesanan.invoice', ['uuid' => $data->uuid]) }}" target="_blank"
                                        class="text-base font-semibold text-gray-900 hover:underline dark:text-white">#{{ $data->invoice_id }}</a>
                                </div>

                                <div class="content-center">
                                    <div class="flex items-center gap-2">
                                        <svg class="h-4 w-4 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                                        </svg>
                                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ \Carbon\Carbon::parse($data->created_at)->format('d F Y') }}</p>
                                    </div>
                                </div>

                                <div class="content-center">
                                    <div class="flex items-center justify-end gap-2 sm:justify-start">
                                        <p class="text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-medium text-gray-900 dark:text-white">{{ $data->kelas->nama }}</span>
                                        </p>
                                    </div>
                                </div>

                                <div class="absolute right-0 top-7 content-center sm:relative sm:right-auto sm:top-auto">
                                    @if ($data->status_pembayaran == 'paid')
                                        <span class="inline-flex items-center rounded  px-2.5 py-0.5 text-xs font-medium
                                            bg-green-100 text-green-500">
                                            Berhasil
                                        </span>
                                    @elseif ($data->status_pembayaran == 'unpaid')
                                        <span class="inline-flex items-center rounded  px-2.5 py-0.5 text-xs font-medium
                                            bg-red-100 text-red-500">
                                            Menunggu Pembayaran
                                        </span>
                                    @elseif ($data->status_pembayaran == 'expired')
                                        <span class="inline-flex items-center rounded  px-2.5 py-0.5 text-xs font-medium
                                            bg-gray-200 text-gray-800">
                                            Kadaluarsa
                                        </span>
                                    @endif

                                </div>

                                <div class="col-span-2 content-center sm:col-span-1 sm:justify-self-end">
                                    <a href="{{ route('pemesanan.invoice', ['uuid' => $data->uuid]) }}" target="_blank"
                                        class="w-full rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
                                        Lihat
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @else
            <div class="flex items-start justify-center">
                <h4 class="text-lg text-gray-400">Anda belum memiliki riwayat pembayaran</h4>
            </div>
        @endif

    </div>
@endsection
