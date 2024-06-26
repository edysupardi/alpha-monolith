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
        Schema::table('patient', function (Blueprint $table) {
            $table->foreign(['company_id'], 'patient_ibfk_1')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'patient_ibfk_2')->references(['id'])->on('person')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->dropForeign('patient_ibfk_1');
            $table->dropForeign('patient_ibfk_2');
        });
    }
};
