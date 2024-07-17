<x-app-layout>


    {{-- <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="separator-sidebar" class="fixed top-20 left-0 z-40 w-80 h-screen transition-transform -translate-x-full md:translate-x-0" aria-label="Sidebar">
        <div class="h-full overflow-y-auto flex-1 px-3 divide-y md:bg-transparent bg-white rounded-lg divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
            <ul class="pb-4 mb-6 space-y-2">
                <li class="pt-6"></li>
                @for ($i = 1; $i < 7; $i++)
                <li class="p-4 bg-white rounded-lg">
                    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-playground-{{ $i }}" data-collapse-toggle="dropdown-playground-{{ $i }}">
                        <svg sidebar-toggle-item="" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item="">
                            Modul {{ $i }}
                        </span>
                        <span class="text-right font-bold">
                            1 / 3
                        </span>
                    </button>
                    <ul id="dropdown-playground-{{ $i }}" class="space-y-2 py-2 hidden ">
                        <li>
                            <a href="#" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 ">
                                <svg class="h-5 w-5 mr-4 text-green-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Materi 1
                            </a>
                        </li>

                        <li>
                            <a href="#" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 ">
                                <svg class="h-4 w-4 ml-1 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
                                </svg>
                                Materi 2
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-100 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 ">
                                <svg class="h-4 w-4 ml-1 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2"></circle>
                                </svg>
                                Materi 3
                            </a>
                        </li>
                    </ul>
                </li>
                @endfor

                <li class="pb-6"></li>
            </ul>
        </div>
    </aside> --}}

    <div class="flex flex-wrap w-full">
        <div class="w-full lg:w-1/4 p-4 order-2 lg:order-1">
            <div class="h-full overflow-y-auto flex-1 divide-y md:bg-transparent bg-white rounded-lg divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                <ul class="pb-4 mb-6 space-y-2">
                    {{-- @for ($i = 1; $i < 7; $i++) --}}
                    <li class="p-4 bg-white rounded-lg">
                        <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-playground" data-collapse-toggle="dropdown-playground">
                            <svg sidebar-toggle-item="" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item="">
                                Modul Pembelajaran 1
                            </span>
                            <span class="text-right font-bold">
                                1 / 3
                            </span>
                        </button>
                        <ul id="dropdown-playground" class="space-y-2 py-2">
                            <li>
                                <Link href="{{ url('/') }}/kelas/kelas-profit-10-juta/1" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->is('kelas/kelas-profit-10-juta/1') ? 'bg-slate-200' : '' }}">
                                    <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                                    Materi 1
                                </Link>
                            </li>

                            <li>
                                <Link href="{{ url('/') }}/kelas/kelas-profit-10-juta/2" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->is('kelas/kelas-profit-10-juta/2') ? 'bg-slate-200' : '' }}">
                                    <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                                    Materi 2
                                </Link>
                            </li>
                            <li>
                                <Link href="{{ url('/') }}/kelas/kelas-profit-10-juta/3" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->is('kelas/kelas-profit-10-juta/3') ? 'bg-slate-200' : '' }}">
                                    <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                                    Materi 3
                                </Link>
                            </li>
                        </ul>
                    </li>
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
