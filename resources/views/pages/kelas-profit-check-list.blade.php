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
                        112 CHECKLIST PUNYA PENGHASILAN PULUHAN JUTA PERBULAN DARI BISNIS
                    </div>
                    <ul class="space-y-2 p-6">
                        @foreach($checklist as $index => $item)
                            <li class="p-4 rounded-lg flex {{ $index % 2 == 0 ? 'bg-gray-100 dark:bg-gray-700' : '' }}">
                                <span class="p-0.5 text-sm font-bold mr-4">{{ $index + 1 }}.</span>
                                <x-splade-form class="flex items-center">
                                    <x-splade-checkbox name="data[]" data-idname="{{ $item['id'] }}" value="{{ $item['value'] }}" label="{{ $item['description'] }}" />
                                </x-splade-form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
