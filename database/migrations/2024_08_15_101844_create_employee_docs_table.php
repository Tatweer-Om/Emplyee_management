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
        Schema::create('employee_docs', function (Blueprint $table) {
            $table->id();
            $table->string('employeedoc_id')->unique(); // Unique identifier for the document
            $table->string('employeedoc_name'); // Name of the document
            $table->date('expiry_date')->nullable(); // Expiry date of the document
            $table->string('all_document'); // Store all document details
            $table->string('employee_id'); // Foreign key for employee
            $table->string('employee_company'); // Store all document details
            $table->string('employee_company_id'); // Foreign key for employee
            $table->string('employee_name'); // Name of the employee
            $table->string('office_user')->nullable(); // Office user related to the document
            $table->string('added_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('user_id', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_docs');
    }
};
