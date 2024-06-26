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
            $table->bigInteger('loan_reference_id')->nullable()->index('loan_reference_id')->comment('referensi peminjaman, terjadi jika berkas RM pindah divisi/unit peminjam');
            $table->integer('company_id')->nullable()->index('medical_record_loan_index_11')->comment('ID dari perusahaan/PT/CV');
            $table->integer('branch_id')->nullable()->index('medical_record_loan_index_12')->comment('ID cabang dari si perusahaan');
            $table->bigInteger('patient_id')->nullable()->index('medical_record_loan_index_13');
            $table->integer('division_unit_id')->nullable()->index('medical_record_loan_index_14')->comment('ID divisi/unit/instalasi dari si peminjam');
            $table->dateTime('loan_time')->nullable()->comment('tanggal peminjaman');
            $table->dateTime('date_of_return')->nullable()->comment('tanggal pengembalian');
            $table->enum('is_overdue', ['late', 'no'])->nullable()->default('no')->comment('pilihan: late (terlambat), no (tidak/tidak terlambat)');
            $table->string('delay_duration', 20)->nullable()->comment('durasi keterlambatan dalam satuan hari');
            $table->enum('loan_status', ['on_progress', 'done', 'cancel'])->nullable()->default('on_progress');
            $table->text('reason_cancel')->nullable()->comment('alasan batal');
            $table->integer('created_by')->nullable()->index('created_by')->comment('id dari user yang menginput, walaupun sama antara dokter dan user');
            $table->timestamp('created_at')->nullable();
            $table->integer('updated_by')->nullable()->index('updated_by')->comment('id dari user yang mengupdate, walaupun sama antara dokter dan user');
            $table->timestamp('updated_at')->nullable();
            $table->integer('delete_by')->nullable()->index('delete_by')->comment('id dari user yang menghapus, walaupun sama antara dokter dan user');
            $table->softDeletes();
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
