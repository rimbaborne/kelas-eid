<ul class="list-none p-0">
    <li class="border-b border-gray-200 hover:bg-gray-100">
        <Link href="{{ route('dashboard') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('dashboard') ? 'bg-slate-50 text-primary-600' : '' }}">
            <x-carbon-dashboard class="w-6 h-6 {{ request()->routeIs('dashboard') ? 'text-primary-600' : '' }}" />
            <div>
                <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('dashboard') ? 'text-primary-600' : 'text-gray-900' }}">Welcome</h6>
            </div>
          </Link>
    </li>
    <li class="border-b border-gray-200 hover:bg-gray-100">
        <Link href="{{ route('dashboard.data') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('data') ? 'bg-slate-50 text-primary-600' : '' }}">
            <x-carbon-data-1 class="w-6 h-6 {{ request()->routeIs('data') ? 'text-primary-600' : '' }}"/>
            <div>
                <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('data') ? 'text-primary-600' : 'text-gray-900' }}">Kelas</h6>
            </div>
          </Link>
    </li>
    <li class="border-gray-200 hover:bg-gray-100">
        <Link href="{{ route('dashboard.pembayaran') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('pembayaran') ? 'bg-slate-50 text-primary-600' : '' }}">
            <x-carbon-money class="w-6 h-6 {{ request()->routeIs('pembayaran') ? 'text-primary-600' : '' }}"/>
            <div>
                <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('pembayaran') ? 'text-primary-600' : 'text-gray-900' }}">Pembayaran</h6>
            </div>
          </Link>
    </li>
    <li class="py-5"></li>

    @if (auth()->user()->hasRole('admin'))
        <li class="border-b border-gray-200 hover:bg-gray-100">
            <Link href="{{ route('admin.transaksi') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('admin.transaksi') ? 'bg-slate-50 text-primary-600' : '' }}">
                <x-carbon-catalog class="w-6 h-6 {{ request()->routeIs('admin.transaksi') ? 'text-primary-600' : '' }}"/>
                <div>
                    <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('admin.transaksi') ? 'text-primary-600' : 'text-gray-900' }}">Transaksi</h6>
                </div>
            </Link>
        </li>

        <li class="border-b border-gray-200 hover:bg-gray-100">
            <Link href="{{ route('admin.peserta') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('admin.peserta') ? 'bg-slate-50 text-primary-600' : '' }}">
                <x-carbon-ibm-lpa class="w-6 h-6 {{ request()->routeIs('admin.peserta') ? 'text-primary-600' : '' }}"/>
                <div>
                    <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('admin.peserta') ? 'text-primary-600' : 'text-gray-900' }}">Peserta</h6>
                </div>
            </Link>
        </li>
        <li class="border-b border-gray-200 hover:bg-gray-100">
            <Link href="{{ route('admin.user') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('admin.user') ? 'bg-slate-50 text-primary-600' : '' }}">
                <x-carbon-gateway-user-access class="w-6 h-6 {{ request()->routeIs('admin.user') ? 'text-primary-600' : '' }}"/>
                <div>
                    <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('admin.user') ? 'text-primary-600' : 'text-gray-900' }}">User</h6>
                </div>
            </Link>
        </li>
    @endif

    @if (auth()->user()->hasRole('agen-plus'))
        <li class="border-b border-gray-200 hover:bg-gray-100">
            <Link href="{{ route('agen.plus') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('agen.plus') ? 'bg-slate-50 text-primary-600' : '' }}">
                <x-carbon-user-military class="w-6 h-6 {{ request()->routeIs('agen.plus') ? 'text-primary-600' : '' }}"/>
                <div>
                    <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('agen.plus') ? 'text-primary-600' : 'text-gray-900' }}">Agen Plus</h6>
                </div>
            </Link>
        </li>
    @endif

    <li class="py-5"></li>

    <li class="border-b border-gray-200 hover:bg-gray-100">
        <Link href="{{ route('profile.edit') }}" class="flex items-center space-x-4 p-4 block {{ request()->routeIs('profile.edit') ? 'bg-slate-50 text-primary-600' : '' }}">
            <x-carbon-user-profile class="w-6 h-6 {{ request()->routeIs('profile.edit') ? 'text-primary-600' : '' }}"/>
            <div>
                <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('profile.edit') ? 'text-primary-600' : 'text-gray-900' }}">Akun</h6>
            </div>
          </Link>
    </li>

    <li class="border-gray-200 hover:bg-gray-100">
        <form method="POST" action="{{ route('logout') }}" class="flex items-center space-x-4 p-4 pl-0 block">
            @csrf
            <button type="submit" class="flex items-center space-x-4 w-full text-left {{ request()->routeIs('logout') ? 'bg-slate-50 text-primary-600' : '' }}">
                <x-carbon-logout class="w-6 h-6 {{ request()->routeIs('logout') ? 'text-primary-600' : '' }}" />
                <div>
                    <h6 class="text-sm font-semibold dark:text-white {{ request()->routeIs('logout') ? 'text-primary-600' : 'text-gray-900' }}">Logout</h6>
                </div>
            </button>
        </form>
    </li>
  </ul>
