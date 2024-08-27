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
        Schema::create('employeedochistories', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id')->nullable();
            $table->string('company_id')->nullable();
            $table->string('employee_company')->nullable();
            $table->string('old_expiry_date')->nullable();
            $table->string('new_expiry')->nullable();
            $table->longText('renewl_note')->nullable();
            $table->string('doc_status')->nullable();
            $table->string('document_id')->nullable();
            $table->string('added_by');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeedochistories');
    }
};
