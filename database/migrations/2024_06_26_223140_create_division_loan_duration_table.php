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
        Schema::create('division_loan_duration', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id', false)->nullable()->index();
            $table->integer('branch_id', false)->nullable()->index();
            $table->integer('division_unit_id', false)->nullable()->index();
            $table->integer('max_duration')->nullable()->comment('satuan dalam jam');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('division_loan_duration', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('division_unit_id')->references('id')->on('division_unit')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_loan_duration');
    }
};
