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
        Schema::create('examination', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV')->references('id')->on('company')->constrained()->cascadeOnDelete();
            $table->integer('branch_id', false)->nullable()->comment('ID cabang dari si perusahaan')->references('id')->on('branch')->constrained()->cascadeOnDelete();
            $table->bigInteger('patient_id', false)->nullable()->index()->comment('ID dari orang nya')->references('id')->on('patient')->constrained()->cascadeOnDelete();
            $table->dateTime('examination_date')->nullable()->comment('tanggal perawatannya');
            $table->bigInteger('doctor_id', false)->nullable()->index()->comment('id dokter nya')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->enum('triage', ['red', 'green', 'yellow', 'black'])->nullable()->comment('di isi jika pasien dari IGD');
            $table->text('subjective')->nullable()->comment('bagian dari SOAP => S');
            $table->text('other_check')->nullable()->comment('bagian dari SOAP => O');
            $table->text('assessment')->nullable()->comment('bagian dari SOAP => A');
            $table->enum('assessment_result', ['outpatient', 'inpatient', 'reference', 'death'])->nullable()->comment('hasil asesmen nya kemana, apakah RJ, RI, rujukan atau meninggal, atau null jika examination sebagai bagian dari pelayanan, contoh hasil examination dari rawat inap');
            $table->text('plan')->nullable()->comment('bagian dari SOAP => P');
            $table->bigInteger('created_by', false)->nullable()->index()->comment('id dari user yang menginput, walaupun sama antara dokter dan user')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->bigInteger('updated_by', false)->nullable()->index()->comment('id dari user yang mengupdate, walaupun sama antara dokter dan user')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->bigInteger('delete_by', false)->nullable()->index()->comment('id dari user yang menghapus, walaupun sama antara dokter dan user')->references('id')->on('employee')->constrained()->cascadeOnDelete();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination');
    }
};
