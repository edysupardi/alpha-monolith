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
            $table->bigInteger('loan_id', false)->index();
            $table->integer('category_id', false)->index();
            $table->integer('company_id', false)->index();
            $table->integer('branch_id', false)->index();
            $table->bigInteger('patient_id', false)->index();
        });

        Schema::table('medical_record_list_form', function (Blueprint $table) {
            $table->foreign('loan_id')->references('id')->on('medical_record_loan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('category_id')->references('id')->on('medical_record_category')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('patient_id')->references('id')->on('patient')->cascadeOnUpdate()->cascadeOnDelete();
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
