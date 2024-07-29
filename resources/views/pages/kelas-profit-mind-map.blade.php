<x-app-layout>

    <div class="flex flex-wrap w-full">
        <div class="w-full lg:w-1/4 p-4 order-2 lg:order-1">
            <div class="h-full overflow-y-auto flex-1 divide-y md:bg-transparent bg-white rounded-lg divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-4 mb-6 space-y-2">
                    {{-- @for ($i = 1; $i < 7; $i++) --}}
                    @include('components.kelas.menu-modul')
                    {{-- @endfor --}}

                    <li class="pb-6"></li>
                </ul>
            </div>
        </div>
        <div class="w-full lg:w-3/4 md:p-4 order-1 lg:order-2 mb-4">
            <div class="bg-white rounded-lg shadow-md md:p-4 dark:bg-gray-800">
                <!-- Konten untuk grid 3/4 -->
                <div class="h-full p-6 flex-1 bg-white divide-y rounded-lg divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    <div class="text-3xl font-bold pb-3">
                        Mind Map Kelas Profit 10 Juta
                    </div>
                    <div class="py-4 flex items-center justify-between">
                        <div></div>

                        <a href="https://whimsical.com/kelas-profit-10-juta-GUJAiEcZgKMMz4nDZrxV5f" target="_blank" class=" border border-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            Full Screen
                        </a>
                    </div>
                    <div class="aspect-[3/4]">
                        <iframe class="h-full w-full rounded-lg" src="https://whimsical.com/embed/kelas-profit-10-juta-GUJAiEcZgKMMz4nDZrxV5f" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
