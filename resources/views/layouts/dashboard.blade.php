<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex md:flex-row flex-col">
                <div class="md:basis-1/4 border p-6 bg-white border-gray-200 rounded-xl hidden md:block md:mr-4 md:mb-0 mb-4">
                    @include('components.dashboard.sidebar')
                </div>
                <div class="md:basis-3/4 border p-6 bg-white border-gray-200 rounded-xl">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <p class="text-center font-bold text-sm text-gray-400">{{ date('Y') }} &copy; Kelas entrepreneurID</p>
        </div>
    </div>

    @include('components.dashboard.menu-mobile')

    <div class="py-4"></div>

</x-app-layout>
