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
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('company_id')->comment('ID dari perusahaan/PT/CV');
            $table->integer('branch_id')->nullable()->index('branch_id')->comment('ID cabang dari si perusahaan');
            $table->integer('employee_id')->nullable()->index('employee_id')->comment('ID employee dari si perusahaan');
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
