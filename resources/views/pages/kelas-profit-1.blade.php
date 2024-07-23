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
        <div class="w-full lg:w-3/4 p-4 order-1 lg:order-2 mb-4">
            <div class="bg-white rounded-lg shadow-md p-4 dark:bg-gray-800">
                <!-- Konten untuk grid 3/4 -->
                <div class="h-full p-6 flex-1 bg-white divide-y rounded-lg divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                    <div class="text-3xl font-bold pb-3">
                        Pendahuluan
                    </div>
                    <div class="aspect-[16/9]">
                        <iframe class="h-full w-full rounded-lg" src="https://www.youtube.com/embed/Uxv6wd2Henc" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
