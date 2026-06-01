<body>

    {{ Route::currentRouteName() }}



    <aside class="w-[260px] shrink-0 bg-[#5CC6E7] text-white px-5 py-6 min-h-screen flex flex-col">

        <!-- Logo -->
        <div class="flex items-center gap-3 mb-12 border-b border-white/20 pb-5">

            <img src="{{ asset('images/logo.jpg') }}" alt="Logo"
                class="w-12 h-12 rounded-full object-cover bg-white p-1">

            <h1 class="text-2xl font-bold tracking-wide">
                Yukshopping
            </h1>

        </div>

        <!-- Menu -->
        <nav class="flex flex-col gap-3">

            {{-- Dashboard --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl text-lg font-medium transition
        {{ request()->routeIs('admin.dashboard')
    ? 'bg-white/20 text-white'
    : 'hover:bg-white/10 text-white' }}">

                <i class="bi bi-grid-fill text-xl"></i>
                <span>Dashboard</span>

            </a>

            {{-- Karyawan --}}
            <a href="{{ route('admin.employees.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl text-lg font-medium transition
        {{ request()->routeIs('admin.employees.*')
    ? 'bg-white/20 text-white'
    : 'hover:bg-white/10 text-white' }}">

                <i class="bi bi-people-fill text-xl"></i>
                <span>Karyawan</span>

            </a>

            {{-- Brand & Sesi --}}
            <a href="{{ route('admin.brand-session') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl text-lg font-medium transition
        {{ request()->routeIs('admin.brand-session')
    ? 'bg-white/20 text-white'
    : 'hover:bg-white/10 text-white' }}">

                <i class="bi bi-tag-fill text-xl"></i>
                <span>Brand & Sesi</span>

            </a>

            {{-- Absensi --}}
            <a href="{{ route('admin.attendance.report') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl text-lg font-medium transition
        {{ request()->routeIs('admin.attendance.*')
    ? 'bg-white/20 text-white'
    : 'hover:bg-white/10 text-white' }}">

                <i class="bi bi-person-check-fill text-xl"></i>
                <span>Absensi & Laporan</span>

            </a>

            {{-- Profile --}}
            <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl text-lg font-medium transition
        {{ request()->routeIs('admin.profile.*')
    ? 'bg-white/20 text-white'
    : 'hover:bg-white/10 text-white' }}">

                <i class="bi bi-person text-xl"></i>
                <span>Profile</span>

            </a>

        </nav>

        <div class="mt-auto bg-white rounded-3xl overflow-hidden shadow-lg">

            <div class="flex items-center gap-3 p-4">

                <div
                    class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-800 text-xl font-semibold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>

                <div>
                    <h3 class="text-gray-800 font-bold leading-none">
                        {{ Auth::user()->name }}
                    </h3>

                    <p class="text-gray-400 text-sm">
                        {{ Auth::user()->email }}
                    </p>
                </div>

            </div>

            <div class="border-t border-gray-200"></div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit"
                    class="w-full flex items-center gap-2 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-500 transition-all duration-300">

                    <i class="bi bi-box-arrow-right"></i>
                    <span>Keluar</span>

                </button>
            </form>

        </div>
    </aside>