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
        Schema::table('examination', function (Blueprint $table) {
            $table->foreign(['company_id'], 'examination_ibfk_1')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['patient_id'], 'examination_ibfk_2')->references(['id'])->on('patient')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['doctor_id'], 'examination_ibfk_3')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['created_by'], 'examination_ibfk_4')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['updated_by'], 'examination_ibfk_5')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['delete_by'], 'examination_ibfk_6')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examination', function (Blueprint $table) {
            $table->dropForeign('examination_ibfk_1');
            $table->dropForeign('examination_ibfk_2');
            $table->dropForeign('examination_ibfk_3');
            $table->dropForeign('examination_ibfk_4');
            $table->dropForeign('examination_ibfk_5');
            $table->dropForeign('examination_ibfk_6');
        });
    }
};
