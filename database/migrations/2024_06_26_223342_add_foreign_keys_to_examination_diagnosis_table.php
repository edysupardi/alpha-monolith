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
        Schema::table('examination_diagnosis', function (Blueprint $table) {
            $table->foreign(['examination_id'], 'examination_diagnosis_ibfk_1')->references(['id'])->on('examination')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['company_id'], 'examination_diagnosis_ibfk_2')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['icd_id'], 'examination_diagnosis_ibfk_3')->references(['id'])->on('icd')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examination_diagnosis', function (Blueprint $table) {
            $table->dropForeign('examination_diagnosis_ibfk_1');
            $table->dropForeign('examination_diagnosis_ibfk_2');
            $table->dropForeign('examination_diagnosis_ibfk_3');
        });
    }
};
