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
            $table->integer('company_id')->nullable()->index('division_loan_duration_index_1');
            $table->integer('branch_id')->nullable()->index('division_loan_duration_index_2');
            $table->integer('division_unit_id')->nullable()->index('division_loan_duration_index_3');
            $table->integer('max_duration')->nullable()->comment('satuan dalam jam');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
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
