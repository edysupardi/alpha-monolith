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
        Schema::create('work_schedule', function (Blueprint $table) {
            $table->bigInteger('id', true)->primary();
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV');
            $table->integer('branch_id', false)->nullable()->index()->comment('ID cabang dari si perusahaan');
            $table->bigInteger('employee_id', false)->nullable()->index()->comment('ID employee dari si perusahaan');
            $table->date('schedule_date')->nullable();
            $table->boolean('is_shifting')->nullable()->default(false)->comment('0:normal, 1:is shifting');
            $table->string('shifting_type', 50)->nullable();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('work_schedule', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('employee_id')->references('id')->on('employee')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_schedule');
    }
};
