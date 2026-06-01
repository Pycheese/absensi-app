<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('brand_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('session_name');

            $table->date('session_date');

            $table->time('start_time');
            $table->time('end_time');

            $table->string('location');

            $table->boolean('is_active')
                ->default(true);

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
