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
        Schema::create('work_present', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('company_id')->comment('ID dari perusahaan/PT/CV');
            $table->integer('branch_id')->nullable()->index('branch_id')->comment('ID cabang dari si perusahaan');
            $table->integer('employee_id')->nullable()->index('employee_id')->comment('ID employee dari si perusahaan');
            $table->integer('schedule_id')->nullable()->index('schedule_id')->comment('ID jadwal kerja');
            $table->dateTime('clockin_time')->nullable();
            $table->double('clockin_lat')->nullable()->comment('bisa jadi tidak perlu save latitude nya');
            $table->double('clockin_lng')->nullable()->comment('bisa jadi tidak perlu save longitude nya');
            $table->string('clockin_photo', 150)->nullable()->comment('bisa jadi tidak perlu save foto');
            $table->dateTime('clockout_time')->nullable()->comment('bisa jadi si karyawan tidak clock out');
            $table->double('clockout_lat')->nullable()->comment('bisa jadi tidak perlu save latitude nya');
            $table->double('clockout_lng')->nullable()->comment('bisa jadi tidak perlu save longitude nya');
            $table->string('clockout_photo', 150)->nullable()->comment('bisa jadi tidak perlu save foto');
            $table->boolean('is_late')->nullable()->default(false)->comment('0:normal, 1:is late');
            $table->double('late_duration')->nullable()->default(0)->comment('satuan dalam detik');
            $table->string('late_measurement', 10)->nullable()->comment('bentuk string dari late duration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_present');
    }
};
