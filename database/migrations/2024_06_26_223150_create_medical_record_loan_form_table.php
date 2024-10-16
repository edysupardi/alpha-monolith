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
            $table->bigInteger('loan_id', false)->nullable()->index();
            $table->integer('category_id', false)->nullable()->index();
            $table->integer('company_id', false)->nullable()->index();
            $table->integer('branch_id', false)->nullable()->index();
            $table->bigInteger('patient_id', false)->nullable()->index();
        });

        Schema::table('medical_record_list_form', function (Blueprint $table) {
            $table->foreign('loan_id')->references('id')->on('medical_record_loan')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('category_id')->references('id')->on('medical_record_category')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('patient_id')->references('id')->on('patient')->cascadeOnUpdate()->nullOnDelete();
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
