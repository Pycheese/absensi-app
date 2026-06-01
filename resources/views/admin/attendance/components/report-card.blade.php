<div class="bg-white rounded-2xl shadow-sm p-5">

    <h3 class="font-semibold mb-4">
        {{ $employee->name }}
    </h3>

    <div class="space-y-2 text-sm">

        <div class="flex justify-between">
            <span>Hadir</span>
            <span class="text-green-600 font-semibold">
                {{ $summary[$employee->id]['hadir'] }}
            </span>
        </div>

        <div class="flex justify-between">
            <span>Terlambat</span>
            <span class="text-yellow-600 font-semibold">
                {{ $summary[$employee->id]['terlambat'] }}
            </span>
        </div>

        <div class="flex justify-between">
            <span>Tidak Hadir</span>
            <span class="text-red-500 font-semibold">
                {{ $summary[$employee->id]['tidak_hadir'] }}
            </span>
        </div>

    </div>

</div>