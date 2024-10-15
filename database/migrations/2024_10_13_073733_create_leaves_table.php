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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('employee_name')->nullable();
            $table->string('employee_phone')->nullable();
            $table->string('leave_image')->nullable();
            $table->string('leave_type')->nullable()->comment('1 Sick Leave, 2 for Yearly');
            $table->string('total_leaves')->nullable();
            $table->string('remaining_leaves')->nullable();
            $table->longText('notes')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('user_id')->nullable();
            $table->string('added_by')->nullable();
            $table->string('duration')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
