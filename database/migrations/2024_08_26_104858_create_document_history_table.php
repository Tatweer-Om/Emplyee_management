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
        Schema::create('document_history', function (Blueprint $table) {
            $table->id(); // Primary key with auto-increment
        
            // Other columns using normal integer data type
            $table->integer('document_id')->unique();
            $table->integer('employee_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('doc_type')->nullable()->comment('1 = Employee Docs, 2 = Company Docs');
            $table->integer('status')->nullable()->comment('1 = Process, 2 = Complete');
            $table->date('old_expiry')->nullable();
            $table->date('new_expiry')->nullable();
            $table->string('doc_name')->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('document_history');
    }
};
