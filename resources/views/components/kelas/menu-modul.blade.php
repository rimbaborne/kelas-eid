<li class="p-4 bg-white rounded-lg">
    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-playground-1" data-collapse-toggle="dropdown-playground-1">
        <svg sidebar-toggle-item="" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item="">
            Materi Utama
        </span>
        {{-- <span class="text-right font-bold">
            1 / 3
        </span> --}}
    </button>
    <ul id="dropdown-playground-1" class="space-y-2 py-2">
        <li>
            <a href="{{ url('/') }}/kelas/kelas-profit-10-juta/1" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700 {{ request()->is('kelas/kelas-profit-10-juta/1') ? 'bg-slate-200' : '' }}">
                <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                Video Pembelajaran
            </a>
        </li>
    </ul>
</li>
<li class="p-4 bg-white rounded-lg">
    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-playground-2" data-collapse-toggle="dropdown-playground-2">
        <svg sidebar-toggle-item="" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item="">
            Bonus
        </span>
        {{-- <span class="text-right font-bold">
            1 / 3
        </span> --}}
    </button>
    @php
        $data_pdf = [
            [ 'nama' => 'Vitamin Finansial', 'link' => '1' ],
            [ 'nama' => 'Mulai dari Awal Lagi', 'link' => '2' ],
            [ 'nama' => '7 Ide Bisnis Puluhan Juta', 'link' => '3' ],
            [ 'nama' => 'Jangan Dulu Bisnis Sebelum Punya Ini', 'link' => '4' ],
            [ 'nama' => 'Agar Bisnismu Terus Tumbuh', 'link' => '5' ],
            [ 'nama' => 'Tembus Target Jualan Online', 'link' => '6' ],
            [ 'nama' => 'Rahasia Jualan Anti Gagal', 'link' => '7' ],
            [ 'nama' => 'Cara Konsiten Tanpa Tekanan', 'link' => '8' ],
            [ 'nama' => 'Waktu Pilihan Allah', 'link' => '9' ],
        ];
    @endphp
    <ul id="dropdown-playground-2" class="space-y-2 py-2">
        @foreach ($data_pdf as $pdf)
            <li>
                <a href="{{ url('/') }}/kelas/kelas-profit-10-juta/pdf/{{ $pdf['link'] }}"
                    class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700
                            {{ request()->is('kelas/kelas-profit-10-juta/pdf/'.$pdf['link']) ? 'bg-slate-200' : '' }}">
                    <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                    {{ $pdf['nama'] }}
                </a>
            </li>
        @endforeach
    </ul>
</li>
<li class="p-4 bg-white rounded-lg">
    <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-gray-200 dark:hover:bg-gray-700" aria-controls="dropdown-playground-3" data-collapse-toggle="dropdown-playground-3">
        <svg sidebar-toggle-item="" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        <span class="flex-1 ml-3 text-left whitespace-nowrap font-bold" sidebar-toggle-item="">
            Fasilitas Tambahan
        </span>
        {{-- <span class="text-right font-bold">
            1 / 3
        </span> --}}
    </button>
    <ul id="dropdown-playground-3" class="space-y-2 py-2">
        <li>
            <a href="https://api.whatsapp.com/send?phone=6281348119393" target="_blank" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                Konsultasi (Link chat WA)
            </a>
        </li>

        <li>
            <a href="https://api.whatsapp.com/send?phone=6285787572580" target="_blank" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                Customer Care (Link chat WA)
            </a>
        </li>
        <li>
            <a href="https://chat.whatsapp.com/Ldun5GaGtEW8Tp9KQIcVqL" target="_blank" class="text-base ml-4 text-gray-900 rounded-lg flex items-center p-2 group hover:bg-gray-400 transition duration-75 dark:text-gray-200 dark:hover:bg-gray-700">
                <x-carbon-triangle-right-solid class="w-2 h-2 mx-4" />
                Tips Bisnis Mingguan (Link ke WA)
            </a>
        </li>
    </ul>
</li>
