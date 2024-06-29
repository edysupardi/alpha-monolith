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
            $table->bigIncrements('id', true);
            $table->integer('company_id')->nullable()->index()->comment('ID dari perusahaan/PT/CV')->on('company')->constrained()->cascadeOnDelete();
            $table->integer('branch_id')->nullable()->index()->comment('ID cabang dari si perusahaan')->on('branch')->constrained()->cascadeOnDelete();
            $table->integer('employee_id')->nullable()->index()->comment('ID employee dari si perusahaan')->on('employee')->constrained()->cascadeOnDelete();
            $table->date('schedule_date')->nullable();
            $table->boolean('is_shifting')->nullable()->default(false)->comment('0:normal, 1:is shifting');
            $table->string('shifting_type', 50)->nullable();
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
        Schema::dropIfExists('work_schedule');
    }
};
