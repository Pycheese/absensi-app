<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('position')->nullable();
            $table->enum('type', ['karyawan', 'admin'])->default('karyawan');

            $table->unsignedTinyInteger('month');
            $table->unsignedSmallInteger('year');

            $table->integer('total_present')->default(0);
            $table->integer('daily_salary')->default(0);
            $table->integer('bonus')->default(0);
            $table->integer('deduction')->default(0);
            $table->integer('total_salary')->default(0);

            $table->date('payment_date')->nullable();
            $table->enum('status', ['paid', 'unpaid'])->default('unpaid');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};