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
        Schema::create('patient', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV')->on('company')->constrained()->cascadeOnDelete();
            $table->bigInteger('person_id', false)->nullable()->index()->comment('ID dari orang nya')->on('person')->constrained()->cascadeOnDelete();
            $table->string('medical_record_number', 18)->nullable()->comment('saat ini masih menggunakan configurasi dari masing-masing instansi, tapi kedepannya akan ada rencana menggunakan NIK, usahakan setiap no RM unik di setiap pasien per company');
            $table->string('medical_record_number_old', 18)->nullable();
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
        Schema::dropIfExists('patient');
    }
};
