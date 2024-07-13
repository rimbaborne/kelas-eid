
<footer class="p-4 mt-10 bg-white sm:p-6 dark:bg-gray-800">
    <div class="mx-auto max-w-screen-xl">
        <div class="md:flex md:justify-between flex-row">
            <div class="basis-1/4">
                <div class="mb-6 md:mb-0">
                    <Link href="/" class="flex items-center">
                        <img src="{{ url('/') }}/assets/img/logo-eid-merah.png" class="mr-3 h-12 sm:h-12" alt="eID Logo" />
                    </Link>
                </div>
            </div>
            <div class="basis-3/4">
                <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-4 text-xs">
                    <div>
                        <h2 class="mb-6 font-semibold text-gray-900 uppercase dark:text-white">Kelas entrepreneurID</h2>
                        <ul class="text-gray-600 dark:text-gray-400">
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Tentang</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Kelas</Link>
                            </li>
                            <li class="mb-4">
                                <Link href="#" class="hover:underline">Kontak</Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="flex flex-wrap justify-center items-center">
            <span class="text-sm text-gray-500 text-center dark:text-gray-400">© {{ date('Y') }} <Link href="#" class="hover:underline">entrepreneurID</Link>
            </span>
        </div>
    </div>
</footer>
