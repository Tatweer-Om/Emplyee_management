<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('employee_docs', function (Blueprint $table) {
            $table->string('doc_status')->after('office_user')->nullable(); // Replace 'existing_column' with the actual column name
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employee_docs', function (Blueprint $table) {
            $table->dropColumn('doc_status');
        });
    }
};
