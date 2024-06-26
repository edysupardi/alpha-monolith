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
            $table->integer('company_id')->nullable()->index('examination_index_7')->comment('ID dari perusahaan/PT/CV');
            $table->integer('branch_id')->nullable()->comment('ID cabang dari si perusahaan');
            $table->bigInteger('patient_id')->nullable()->index('examination_index_8')->comment('ID dari orang nya');
            $table->dateTime('examination_date')->nullable()->comment('tanggal perawatannya');
            $table->integer('doctor_id')->nullable()->index('doctor_id')->comment('id dokter nya');
            $table->enum('triage', ['red', 'green', 'yellow', 'black'])->nullable()->comment('di isi jika pasien dari IGD');
            $table->text('subjective')->nullable()->comment('bagian dari SOAP => S');
            $table->text('other_check')->nullable()->comment('bagian dari SOAP => O');
            $table->text('assessment')->nullable()->comment('bagian dari SOAP => A');
            $table->enum('assessment_result', ['outpatient', 'inpatient', 'reference', 'death'])->nullable()->comment('hasil asesmen nya kemana, apakah RJ, RI, rujukan atau meninggal, atau null jika examination sebagai bagian dari pelayanan, contoh hasil examination dari rawat inap');
            $table->text('plan')->nullable()->comment('bagian dari SOAP => P');
            $table->integer('created_by')->nullable()->index('created_by')->comment('id dari user yang menginput, walaupun sama antara dokter dan user');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->integer('updated_by')->nullable()->index('updated_by')->comment('id dari user yang mengupdate, walaupun sama antara dokter dan user');
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->integer('delete_by')->nullable()->index('delete_by')->comment('id dari user yang menghapus, walaupun sama antara dokter dan user');
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
