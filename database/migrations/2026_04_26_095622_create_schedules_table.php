<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->string('brand_name');
            $table->string('session_name')->nullable();

            $table->date('session_date');

            $table->time('start_time');
            $table->time('end_time');

            $table->string('location')->nullable();

            $table->foreignId('qr_code_id')
                ->nullable()
                ->constrained()
                ->onDelete('cascade');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
