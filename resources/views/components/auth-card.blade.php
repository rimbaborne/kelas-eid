<div class="min-h-screen flex flex-col sm:justify-center items-center sm:pt-0 bg-gray-100">
    <div>
        {{-- @isset($logo)
            {{ $logo }}
        @else
            <Link href="/" class="flex items-center justify-center">
                <x-application-logo class="fill-current text-gray-500" />
            </Link>
        @endisset --}}
    </div>

    <div class="w-full sm:max-w-md px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
