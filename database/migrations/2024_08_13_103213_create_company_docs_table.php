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
        Schema::create('company_docs', function (Blueprint $table) {
            $table->id();

            $table->string('companydoc_id')->unique(); // Unique identifier for the document
            $table->string('companydoc_name'); // Name of the document
            $table->date('expiry_date')->nullable(); // Expiry date of the document
            $table->string('all_document'); // Store all document details
            $table->string('company_id'); // Foreign key for company
            $table->string('company_name'); // Name of the company
            $table->string('office_user')->nullable(); // Office user related to the document
            $table->string('added_by')->nullable();
            $table->string('updated_by')->nullable();
            $table->string('user_id', 255)->nullable();
            $table->timestamps(); // Created and updated timestamps

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_docs');
    }
};
