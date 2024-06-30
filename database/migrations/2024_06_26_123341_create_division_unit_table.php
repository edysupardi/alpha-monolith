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
        Schema::create('division_unit', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id', false)->nullable()->index();
            $table->integer('branch_id', false)->nullable()->index();
            $table->integer('parent_id', false)->nullable()->index();
            $table->string('name', 255)->nullable();
            $table->enum('is_can_loan_rm_file', ['yes', 'no'])->nullable()->default('no')->comment('status apakah divisi/unit tersebut boleh pinjam rm');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('division_unit', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('parent_id')->references('id')->on('division_unit')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_unit');
    }
};
