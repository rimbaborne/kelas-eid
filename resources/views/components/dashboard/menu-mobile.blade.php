<!-- Sticky Navbar -->
<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg md:hidden">
    <div class="flex justify-around">
        <!-- Dashboard Button -->
        <Link href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center p-2 pt-3 {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-gray-600' }} hover:bg-gray-100 hover:text-primary-600">
            <x-carbon-dashboard class="w-6 h-6 mb-1 {{ request()->routeIs('dashboard') ? 'text-primary-600' : '' }}" />
            <span class="text-md">Dashboard</span>
        </Link>
        <!-- Data Button -->
        <Link href="{{ route('data') }}" class="flex flex-col items-center justify-center p-2 pt-3 {{ request()->routeIs('data') ? 'text-primary-600' : 'text-gray-600' }} hover:bg-gray-100 hover:text-primary-600">
            <x-carbon-data-1 class="w-6 h-6 mb-1 {{ request()->routeIs('data') ? 'text-primary-600' : '' }}"/>
            <span class="text-md">Data</span>
        </Link>
        <!-- Informasi Button -->
        <Link href="{{ route('pembayaran') }}" class="flex flex-col items-center justify-center p-2 pt-3 {{ request()->routeIs('pembayaran') ? 'text-primary-600' : 'text-gray-600' }} hover:bg-gray-100 hover:text-primary-600">
            <x-carbon-money class="w-6 h-6 mb-1 {{ request()->routeIs('pembayaran') ? 'text-primary-600' : '' }}"/>
            <span class="text-md">Pembayaran</span>
        </Link>
        <!-- Akun Button -->
        <Link href="{{ route('profile.edit') }}" class="flex flex-col items-center justify-center p-2 pt-3 {{ request()->routeIs('profile.edit') ? 'text-primary-600' : 'text-gray-600' }} hover:bg-gray-100 hover:text-primary-600">
            <x-carbon-user-profile class="w-6 h-6 mb-1 {{ request()->routeIs('profile.edit') ? 'text-primary-600' : '' }}"/>
            <span class="text-md">Akun</span>
        </Link>
    </div>
  </div>
