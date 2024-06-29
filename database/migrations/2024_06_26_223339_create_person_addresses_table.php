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
        Schema::create('person_addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV')->on('company')->constrained()->cascadeOnDelete();
            $table->bigInteger('person_id', false)->nullable()->index()->on('person')->constrained()->cascadeOnDelete();
            $table->integer('address_type_id', false)->nullable()->index()->comment('bisa jadi alamat domisili, atau alamat ktp')->on('address_type')->constrained()->cascadeOnDelete();
            $table->text('address')->nullable();
            $table->tinyInteger('rt')->nullable();
            $table->tinyInteger('rw')->nullable();
            $table->integer('village_id', false)->nullable()->index();
            $table->integer('subdistrict_id', false)->nullable()->index();
            $table->integer('regency_id', false)->nullable()->index();
            $table->integer('province_id', false)->nullable()->index();
            $table->integer('country_id', false)->nullable()->index();
            $table->tinyInteger('postal_code')->nullable();
            $table->string('phone_number', 30)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_addresses');
    }
};
