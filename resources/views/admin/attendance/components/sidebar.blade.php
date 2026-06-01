<aside class="fixed left-0 top-0 w-[260px] h-screen bg-[#5CC6E7] p-6 flex flex-col text-white">

    {{-- TOP --}}
    <div>

        {{-- LOGO --}}
        <div class="mb-10">

            <h1 class="text-3xl font-bold">
                Yukshopping
            </h1>

        </div>

        {{-- MENU --}}
        <nav class="space-y-3">

            <a href="{{ route('admin.dashboard') }}"
                class="block px-4 py-3 rounded-2xl hover:scale-[1.02] hover:shadow-lg transition-all duration-300">

                Dashboard

            </a>

            <a href="{{ route('admin.employees.index') }}"
                class="block px-4 py-3 rounded-2xl hover:scale-[1.02] hover:shadow-lg transition-all duration-300">

                Karyawan

            </a>

            <a href="{{ route('admin.brand-session') }}"
                class="block px-4 py-3 rounded-2xl hover:scale-[1.02] hover:shadow-lg transition-all duration-300">

                Brand & Sesi

            </a>

            <a href="{{ route('admin.attendance.report') }}"
                class="block px-4 py-3 rounded-2xl hover:scale-[1.02] hover:shadow-lg transition-all duration-300">

                Absensi & Laporan

            </a>

        </nav>

    </div>

    {{-- PROFILE + LOGOUT --}}
    <div class="mt-auto bg-white rounded-3xl p-4 text-gray-800 shadow">

        <div class="mb-4">

            <h3 class="font-semibold">
                {{ auth()->user()->name }}
            </h3>

            <p class="text-sm text-gray-500">
                {{ auth()->user()->email }}
            </p>

        </div>

        <form action="{{ route('logout') }}" method="POST">

            @csrf

            <button type="submit" class="w-full bg-red-50 text-red-500 py-3 rounded-2xl hover:bg-red-100 transition">

                Logout

            </button>

        </form>

    </div>

</aside>