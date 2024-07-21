<p class="text-center text-sm text-gray-600">
    Halaman ini akan refresh secara automatis setiap 2 menit untuk memeriksa pembayaran
</p>
<x-splade-script>
    document.addEventListener("DOMContentLoaded", function() {
        setInterval(function() {
            location.reload();
        }, 120000); // 120000 milliseconds = 2 minutes
    });
</x-splade-script>



<div class="bg-gray-100">
    <div class="text-center py-8 bg-gray-100">
        <p class="text-sm text-gray-600">
            <Link href="{{ url('/') }}" class="text-md text-gray-600 hover:text-gray-900">
            &larr; Kembali
            </Link>
        </p>
    </div>

    <!-- Invoice -->
    <div class="max-w-[70rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
        <div class="sm:w-11/12 lg:w-3/4 mx-auto">
            <!-- Card -->
            <div class="flex flex-col p-4 sm:p-10 bg-white shadow-md rounded-xl dark:bg-neutral-800">
                <!-- Grid -->
                <div class="flex justify-between">
                    <div>
                        <img src="{{ url('/') }}/assets/img/lttq.png" alt="eID" class="h-12">
                        <h1 class="mt-2 text-lg md:text-xl font-semibold text-gray-800 dark:text-white">entreprenurID
                        </h1>
                    </div>
                    <!-- Col -->

                    <div class="text-end">
                        <h2 class="text-2xl md:text-3xl font-semibold text-gray-800 dark:text-neutral-200">Invoice #
                        </h2>
                        <span class="mt-1 block text-gray-500 dark:text-neutral-500">{{ $transaction->invoice_id }}</span>

                        {{-- <address class="mt-4 not-italic text-gray-800 dark:text-neutral-200">
                            45 Roker Terrace<br>
                            Latheronwheel<br>
                            KW5 8NW, London<br>
                            United Kingdom<br>
                        </address> --}}
                    </div>
                    <!-- Col -->
                </div>
                <!-- End Grid -->

                <!-- Grid -->
                <div class="mt-8 grid sm:grid-cols-2 gap-3">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Kepada:</h3>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">{{ $transaction->user->name }}</h3>
                        <address class="mb-2 not-italic text-gray-500 dark:text-neutral-500">
                            {{ $transaction->user->email }}<br>
                            {{ $transaction->user->phone_code.$transaction->user->phone_number }}<br>
                        </address>
                    </div>
                    <!-- Col -->

                    <div class="sm:text-end space-y-2">
                        <!-- Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Tanggal Invoice:
                                </dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Batas Pembayaran:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">{{ \Carbon\Carbon::parse($transaction->batas_bayar)->format('d/m/Y H:i') }}</dd>
                            </dl>
                            <dl class="grid sm:grid-cols-5 gap-x-3">
                                <dt class="col-span-3 font-semibold text-gray-800 dark:text-neutral-200">Status Pembayaran:</dt>
                                <dd class="col-span-2 text-gray-500 dark:text-neutral-500">
                                    @if($transaction->status_pembayaran == 'paid')
                                        <span class="bg-green-500 text-white px-2 py-1 rounded text-sm">LUNAS</span>
                                    @elseif($transaction->status_pembayaran == 'unpaid')
                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">BELUM LUNAS</span>
                                    @elseif($transaction->status_pembayaran == 'expired')
                                        <span class="bg-red-500 text-white px-2 py-1 rounded text-sm">EXPIRED</span>
                                    @endif
                                </dd>
                            </dl>
                        </div>
                        <!-- End Grid -->
                    </div>
                    <!-- Col -->
                </div>
                <!-- End Grid -->
                <div class="flex items-center justify-center mt-6">
                    <div class="w-full md:w-2/5">
                        <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                            <a href="#" class="shrink-0">
                                <img class="w-28 p-2 sm:p-3" src="https://admin.entrepreneurid.org/img/produk/KPS-2024-1.png">
                            </a>
                            <div class="w-full min-w-0 flex-1 space-y-2 md:max-w-md">
                                <h5 class=" text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                    Produk
                                </h5>
                                <h1 class="text-xl font-semibold text-gray-900 hover:underline dark:text-white">
                                    Kelas Profit 10 Juta
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Table -->
                <div class="mt-0">
                    <div class=" rounded-lg space-y-4 dark:border-neutral-700">
                        <div class="rounded-lg bg-white p-2 md:p-4">

                        </div>
                        <div class="mt-5">
                            <ul class="mt-3 flex flex-col">
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                <div class="flex items-center justify-between w-full">
                                    <span>Harga</span>
                                    <span>RP 57.000</span>
                                </div>
                                </li>
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:border-neutral-700 dark:text-neutral-200">
                                <div class="flex items-center justify-between w-full">
                                    <span>Biaya Transaksi</span>
                                    <span>Rp {{ number_format($transaction->fee, 0, ',', '.') }}</span>
                                </div>
                                </li>
                                <li class="inline-flex items-center gap-x-2 py-3 px-4 text-sm font-semibold bg-gray-50 border text-gray-800 -mt-px first:rounded-t-lg first:mt-0 last:rounded-b-lg dark:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-200">
                                <div class="flex items-center justify-between w-full">
                                    <span>Total</span>
                                    <span>Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                                </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- End Table -->
                <div class=" flex items-center justify-center">
                    <div class="mt-6 w-full md:w-2/5">
                        <div class=" rounded-lg space-y-4 dark:border-neutral-700">
                            <div class="rounded-lg bg-white p-2 md:p-4">
                                <div class="space-y-2 flex items-center justify-between gap-6 md:space-y-0">
                                    <div class="w-full min-w-0 flex-1 md:max-w-md">
                                        <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Metode Pembayaran
                                        </h5>
                                        <div class="flex items-center justify-between mb-4">
                                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                @if($transaction->channel == 'QRIS')
                                                    Scan QRIS
                                                @else
                                                    Bank {{ $transaction->channel }}
                                                @endif
                                            </h1>
                                            <img src="{{ url('/') }}/assets/pembayaran/{{ strtolower($transaction->channel) }}.png" alt="{{ $transaction->channel }}" class="h-6 mr-2">
                                        </div>
                                        @if($transaction->channel == 'QRIS')
                                            <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Barcode
                                            </h5>
                                            <h4 class="text-lg font-medium">
                                                NMID : {{ $transaction->qris_nmid }}
                                            </h4>
                                            <div class="flex items-center justify-center mb-4">
                                                <x-splade-lazy>
                                                    <x-slot:placeholder>Loading QRIS ...</x-slot:placeholder>
                                                    <img src="https://api.qrserver.com/v1/create-qr-code/?data={{ $transaction->qris_string }}&size=250x250" alt="QRIS" class="">
                                                </x-splade-lazy>
                                            </div>
                                        @else
                                            <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                Nomor Virtual Akun
                                            </h5>
                                            <div class="flex items-center justify-between mb-4">
                                                <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                    {{ $transaction->payment_number }}
                                                </h1>
                                                <button id="copyButton" class="ml-2 border border-gray-200 px-2 py-1 rounded text-sm">Copy</button>
                                                <x-splade-script>
                                                    document.addEventListener("DOMContentLoaded", function() {
                                                        document.getElementById('copyButton').addEventListener('click', function() {
                                                            var tempInput = document.createElement('input');
                                                            tempInput.value = '{!! $transaction->payment_number !!}';
                                                            document.body.appendChild(tempInput);
                                                            tempInput.select();
                                                            document.execCommand('copy');
                                                            document.body.removeChild(tempInput);
                                                            alert('Nomor Virtual Akun berhasil disalin');
                                                        });
                                                    });
                                                </x-splade-script>
                                            </div>
                                        @endif
                                        <h5 class="text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                            Total Pembayaran
                                        </h5>
                                        <div class="flex items-center justify-between">
                                            <h1 class="text-xl mt-0 font-semibold text-gray-900 hover:underline dark:text-white">
                                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                                            </h1>
                                            <button id="copyButtonTotal" class="ml-2 border border-gray-200 px-2 py-1 rounded text-sm">Copy</button>
                                            <x-splade-script>
                                                document.addEventListener("DOMContentLoaded", function() {
                                                    document.getElementById('copyButtonTotal').addEventListener('click', function() {
                                                        var tempInput = document.createElement('input');
                                                        tempInput.value = '{!! $transaction->total !!}';
                                                        document.body.appendChild(tempInput);
                                                        tempInput.select();
                                                        document.execCommand('copy');
                                                        document.body.removeChild(tempInput);
                                                        alert('Total Nominal berhasil disalin');
                                                    });
                                                });
                                            </x-splade-script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="mt-8 sm:mt-12">
                    <h4 class="text-lg font-semibold text-gray-800 dark:text-neutral-200">Terima Kasih !</h4>
                    <p class="text-gray-500 text-sm dark:text-neutral-500">
                        Semoga produk kami dapat membantu dalam kehidupan bisnis Anda.
                    </p>
                    <div class="">
                        <p class="block text-sm  text-gray-500 dark:text-neutral-200">kelasentrepreneurid.com</p>
                        {{-- <p class="block text-sm  text-gray-800 dark:text-neutral-200">+1 (062) 109-9222</p> --}}
                    </div>
                </div>

            </div>
            <!-- End Card -->

            <!-- Buttons -->
            {{-- <div class="mt-6 flex justify-end gap-x-3">
                <a class="py-2 px-3 inline-flex justify-center items-center gap-2 rounded-lg border font-medium bg-white text-gray-700 shadow-sm align-middle hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-blue-600 transition-all text-sm dark:bg-neutral-800 dark:hover:bg-neutral-800 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-offset-gray-800"
                    href="#">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                        <polyline points="7 10 12 15 17 10" />
                        <line x1="12" x2="12" y1="15" y2="3" />
                    </svg>
                    Invoice PDF
                </a>
                <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    href="#">
                    <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="6 9 6 2 18 2 18 9" />
                        <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                        <rect width="12" height="8" x="6" y="14" />
                    </svg>
                    Print
                </a>
            </div> --}}
            <!-- End Buttons -->
        </div>
    </div>
    <!-- End Invoice -->

    <div class="text-center py-8 bg-gray-100">
        <div class="flex items-center justify-center">
            <img src="{{ url('/') }}/assets/pembayaran/SSL-Secured.svg" alt="ssl" class="h-24 pt-3">
            <img class="h-12 mt-5 rounded-md" src="https://ipaymu.com/wp-content/themes/ipaymu_v2/assets/new-assets/image/iPaymu-PCIDSS.jpeg" alt="ipaymu">
        </div>
        <p class="text-sm text-gray-600">
            &copy; {{ date('Y') }} entrepreneurID. All rights reserved.
        </p>
    </div>
</div>

