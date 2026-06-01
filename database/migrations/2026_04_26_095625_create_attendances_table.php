<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('schedule_id')
                ->constrained()
                ->cascadeOnDelete();

            // waktu absen masuk
            $table->timestamp('check_in')->nullable();

            // waktu absen keluar
            $table->timestamp('check_out')->nullable();

            // status absensi
            $table->enum('status', [
                'belum_absen',
                'hadir',
                'terlambat',
                'selesai'
            ])->default('belum_absen');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};