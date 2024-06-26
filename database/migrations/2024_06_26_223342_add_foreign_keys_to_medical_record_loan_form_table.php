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
        Schema::table('medical_record_loan_form', function (Blueprint $table) {
            $table->foreign(['medical_record_form_id'], 'medical_record_loan_form_ibfk_1')->references(['id'])->on('medical_record_form')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['medical_record_loan_id'], 'medical_record_loan_form_ibfk_2')->references(['id'])->on('medical_record_loan')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['company_id'], 'medical_record_loan_form_ibfk_3')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['branch_id'], 'medical_record_loan_form_ibfk_4')->references(['id'])->on('branch')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['patient_id'], 'medical_record_loan_form_ibfk_5')->references(['id'])->on('patient')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('medical_record_loan_form', function (Blueprint $table) {
            $table->dropForeign('medical_record_loan_form_ibfk_1');
            $table->dropForeign('medical_record_loan_form_ibfk_2');
            $table->dropForeign('medical_record_loan_form_ibfk_3');
            $table->dropForeign('medical_record_loan_form_ibfk_4');
            $table->dropForeign('medical_record_loan_form_ibfk_5');
        });
    }
};
