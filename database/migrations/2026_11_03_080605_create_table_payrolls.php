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
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('period_month');
            $table->smallInteger('period_year')->default(date('Y'));
            $table->double('gross_salary')->default(0);
            $table->double('deduction')->default(0);
            $table->double('net_salary')->default(0);
            $table->text('notes')->nullable();
            $table->enum('status', ['draft', 'final'])->default('draft');
            $table->unsignedBigInteger('generated_by')->foreign('generated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payrolls');
    }
};
