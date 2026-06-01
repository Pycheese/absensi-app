<div
    class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-100 px-4 py-3 flex justify-around items-center z-50 shadow-[0_-2px_20px_rgba(0,0,0,0.04)]">

    <!-- HOME -->
    <a href="{{ route('dashboard') }}" class="flex flex-col items-center gap-1 w-16 transition-all duration-200
        {{ request()->routeIs('dashboard') ? 'text-[#2FC3E6]' : 'text-gray-400' }}">

        <div class="w-10 h-10 rounded-2xl flex items-center justify-center
            {{ request()->routeIs('dashboard') ? 'bg-[#EAF8FC]' : '' }}">

            <i class="bi bi-house text-xl"></i>
        </div>

        <span class="text-[11px] font-medium">
            Home
        </span>
    </a>

    <!-- SCHEDULE -->
    <a href="{{ route('schedule.index') }}" class="flex flex-col items-center gap-1 w-16 transition-all duration-200
        {{ request()->routeIs('schedule.*') ? 'text-[#2FC3E6]' : 'text-gray-400' }}">

        <div class="w-10 h-10 rounded-2xl flex items-center justify-center
            {{ request()->routeIs('schedule.*') ? 'bg-[#EAF8FC]' : '' }}">

            <i class="bi bi-calendar3 text-xl"></i>
        </div>

        <span class="text-[11px] font-medium">
            Jadwal
        </span>
    </a>

    <!-- HISTORY -->
    <a href="{{ route('attendance.history') }}" class="flex flex-col items-center gap-1 w-16 transition-all duration-200
        {{ request()->routeIs('attendance.history') ? 'text-[#2FC3E6]' : 'text-gray-400' }}">

        <div class="w-10 h-10 rounded-2xl flex items-center justify-center
            {{ request()->routeIs('attendance.history') ? 'bg-[#EAF8FC]' : '' }}">

            <i class="bi bi-clock-history text-xl"></i>
        </div>

        <span class="text-[11px] font-medium">
            Riwayat
        </span>
    </a>

    <!-- PROFILE -->
    <a href="{{ route('profile.edit') }}" class="flex flex-col items-center gap-1 w-16 transition-all duration-200
        {{ request()->routeIs('profile.*') ? 'text-[#2FC3E6]' : 'text-gray-400' }}">

        <div class="w-10 h-10 rounded-2xl flex items-center justify-center
            {{ request()->routeIs('profile.*') ? 'bg-[#EAF8FC]' : '' }}">

            <i class="bi bi-person text-xl"></i>
        </div>

        <span class="text-[11px] font-medium">
            Profile
        </span>
    </a>

</div>