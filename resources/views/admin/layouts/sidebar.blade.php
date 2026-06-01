<aside class="w-[260px] shrink-0 bg-[#5CC6E7] text-white px-5 py-6 h-screen sticky top-0 flex flex-col">

    {{-- Logo --}}
    <div class="flex items-center gap-3 mb-10 border-b border-white/20 pb-5">

        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-12 h-12 rounded-full object-cover bg-white p-1">

        <h1 class="text-2xl font-bold tracking-wide">
            Yukshopping
        </h1>

    </div>

    {{-- Menu --}}
    <nav class="flex flex-col gap-3 flex-1">

        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('admin.dashboard')
    ? 'bg-white text-[#20BDE3] font-semibold'
    : 'text-white hover:bg-white/10' }}">
            <i class="bi bi-grid"></i>
            Dashboard
        </a>

        <a href="{{ route('admin.employees.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('admin.employees.*')
    ? 'bg-white text-[#20BDE3] font-semibold'
    : 'text-white hover:bg-white/10' }}">
            <i class="bi bi-people"></i>
            Karyawan
        </a>

        <a href="{{ route('admin.brand-session') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('admin.brand-session') ||
    request()->routeIs('admin.brands.*') ||
    request()->routeIs('admin.schedules.*')
    ? 'bg-white text-[#20BDE3] font-semibold'
    : 'text-white hover:bg-white/10' }}">
            <i class="bi bi-calendar-event"></i>
            Brand & Sesi
        </a>

        <a href="{{ route('admin.attendance.report') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('admin.attendance.report*')
    ? 'bg-white text-[#20BDE3] font-semibold'
    : 'text-white hover:bg-white/10' }}">
            <i class="bi bi-clipboard-check"></i>
            Absensi & Laporan
        </a>

        <a href="{{ route('admin.payroll.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('admin.payroll.*')
    ? 'bg-white text-[#20BDE3] font-semibold'
    : 'text-white hover:bg-white/10' }}">
            <i class="bi bi-wallet2"></i>
            Keuangan
        </a>

        <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition
            {{ request()->routeIs('admin.profile.*')
    ? 'bg-white text-[#20BDE3] font-semibold'
    : 'text-white hover:bg-white/10' }}">
            <i class="bi bi-person-circle"></i>
            Profile
        </a>

    </nav>

    {{-- Profile Card --}}
    <div class="mt-6 bg-white rounded-3xl overflow-hidden shadow-lg shrink-0">

        <div class="flex items-center gap-3 p-4">

            <div
                class="w-11 h-11 rounded-full bg-gray-200 flex items-center justify-center text-gray-800 text-lg font-semibold shrink-0">
                {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
            </div>

            <div class="min-w-0">
                <h3 class="text-gray-800 font-bold leading-tight truncate max-w-[150px]">
                    {{ auth()->user()->name }}
                </h3>

                <p class="text-gray-400 text-sm truncate max-w-[150px]">
                    {{ auth()->user()->email }}
                </p>
            </div>

        </div>

        <div class="border-t border-gray-200"></div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="w-full flex items-center gap-2 px-4 py-3 text-gray-700 hover:bg-red-50 hover:text-red-500 transition">
                <i class="bi bi-box-arrow-right"></i>
                <span>Keluar</span>
            </button>
        </form>

    </div>
</aside>