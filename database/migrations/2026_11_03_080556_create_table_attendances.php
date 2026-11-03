<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->time('check_in');
            $table->time('check_out');
            $table->enum('status', ['PRESENT', 'ABSENT', 'LATE', 'SICK'])->default('ABSENT');
            $table->string('late_reason')->nullable();
            $table->foreignId('employee_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
