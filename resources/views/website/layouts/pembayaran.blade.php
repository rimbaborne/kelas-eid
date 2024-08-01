{{-- @include('website.partials.header-pembayaran') --}}
@yield('content')
<div class="text-center py-8 ">
    <div class="flex items-center justify-center">
        <img src="{{ url('/') }}/assets/pembayaran/SSL-Secured.svg" alt="ssl" class="h-24 pt-3">
        <img class="h-12 mt-5 rounded-md" src="https://ipaymu.com/wp-content/themes/ipaymu_v2/assets/new-assets/image/iPaymu-PCIDSS.jpeg" alt="ipaymu">
    </div>
    <p class="text-sm text-gray-600">
        &copy; {{ date('Y') }} entrepreneurID. All rights reserved.
    </p>
</div>
