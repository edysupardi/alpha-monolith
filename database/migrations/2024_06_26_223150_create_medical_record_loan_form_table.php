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
        Schema::create('medical_record_list_form', function (Blueprint $table) {
            $table->bigInteger('loan_id', false)->nullable()->index()->on('medical_record_loan')->constrained()->cascadeOnDelete();
            $table->integer('category_id', false)->nullable()->index()->on('medical_record_category')->constrained()->cascadeOnDelete();
            $table->integer('company_id', false)->nullable()->index()->on('company')->constrained()->cascadeOnDelete();
            $table->integer('branch_id', false)->nullable()->index()->on('branch')->constrained()->cascadeOnDelete();
            $table->bigInteger('patient_id', false)->nullable()->index()->on('patient')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_list_form');
    }
};
