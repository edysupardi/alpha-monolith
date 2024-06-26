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
        Schema::create('medical_record_loan_form', function (Blueprint $table) {
            $table->bigInteger('medical_record_loan_id')->nullable()->index('medical_record_loan_id');
            $table->integer('medical_record_form_id')->nullable()->index('medical_record_form_id');
            $table->integer('company_id')->nullable()->index('company_id');
            $table->integer('branch_id')->nullable()->index('branch_id');
            $table->bigInteger('patient_id')->nullable()->index('patient_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_loan_form');
    }
};
