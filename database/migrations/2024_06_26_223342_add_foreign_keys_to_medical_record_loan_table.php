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
        Schema::table('medical_record_loan', function (Blueprint $table) {
            $table->foreign(['patient_id'], 'medical_record_loan_ibfk_1')->references(['id'])->on('patient')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['branch_id'], 'medical_record_loan_ibfk_2')->references(['id'])->on('branch')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['company_id'], 'medical_record_loan_ibfk_3')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['division_unit_id'], 'medical_record_loan_ibfk_4')->references(['id'])->on('division_unit')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['created_by'], 'medical_record_loan_ibfk_5')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['updated_by'], 'medical_record_loan_ibfk_6')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['delete_by'], 'medical_record_loan_ibfk_7')->references(['id'])->on('employee')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['loan_reference_id'], 'medical_record_loan_ibfk_8')->references(['id'])->on('medical_record_loan')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_record_loan', function (Blueprint $table) {
            $table->dropForeign('medical_record_loan_ibfk_1');
            $table->dropForeign('medical_record_loan_ibfk_2');
            $table->dropForeign('medical_record_loan_ibfk_3');
            $table->dropForeign('medical_record_loan_ibfk_4');
            $table->dropForeign('medical_record_loan_ibfk_5');
            $table->dropForeign('medical_record_loan_ibfk_6');
            $table->dropForeign('medical_record_loan_ibfk_7');
            $table->dropForeign('medical_record_loan_ibfk_8');
        });
    }
};
