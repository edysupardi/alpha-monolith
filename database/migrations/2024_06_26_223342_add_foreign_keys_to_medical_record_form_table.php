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
        Schema::table('medical_record_form', function (Blueprint $table) {
            $table->foreign(['company_id'], 'medical_record_form_ibfk_1')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_record_form', function (Blueprint $table) {
            $table->dropForeign('medical_record_form_ibfk_1');
        });
    }
};
