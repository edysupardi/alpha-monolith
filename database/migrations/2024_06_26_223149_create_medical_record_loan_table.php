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
        Schema::create('medical_record_loan', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->bigInteger('loan_reference_id', false)->nullable()->index()->comment('referensi peminjaman, terjadi jika berkas RM pindah divisi/unit peminjam');
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV')->references('id')->on('company')->constrained()->cascadeOnDelete();
            $table->integer('branch_id', false)->nullable()->index()->comment('ID cabang dari si perusahaan')->references('id')->on('branch')->constrained()->cascadeOnDelete();
            $table->bigInteger('patient_id')->nullable()->index();
            $table->integer('division_unit_id', false)->nullable()->index()->comment('ID divisi/unit/instalasi dari si peminjam')->references('id')->on('division_unit')->constrained()->cascadeOnDelete();
            $table->dateTime('loan_time')->nullable()->comment('tanggal peminjaman');
            $table->dateTime('date_of_return')->nullable()->comment('tanggal pengembalian');
            $table->enum('is_overdue', ['late', 'no'])->nullable()->default('no')->comment('pilihan: late (terlambat), no (tidak/tidak terlambat)');
            $table->string('delay_duration', 20)->nullable()->comment('durasi keterlambatan dalam satuan hari');
            $table->enum('loan_status', ['on_progress', 'done', 'cancel'])->nullable()->default('on_progress');
            $table->text('reason_cancel')->nullable()->comment('alasan batal');
            $table->bigInteger('created_by')->nullable()->index()->comment('id dari user yang menginput, walaupun sama antara dokter dan user')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();
            $table->bigInteger('updated_by')->nullable()->index()->comment('id dari user yang mengupdate, walaupun sama antara dokter dan user')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->timestamp('updated_at')->nullable();
            $table->bigInteger('delete_by')->nullable()->index()->comment('id dari user yang menghapus, walaupun sama antara dokter dan user')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->softDeletes();
        });

        Schema::table('medical_record_loan', function (Blueprint $table) {
            $table->foreign('loan_reference_id')->references('id')->on('medical_record_loan')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('patient_id')->references('id')->on('patient')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_record_loan');
    }
};
