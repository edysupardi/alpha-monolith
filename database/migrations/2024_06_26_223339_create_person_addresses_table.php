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
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV');
            $table->bigInteger('person_id', false)->nullable()->index();
            $table->integer('address_type_id', false)->nullable()->index()->comment('bisa jadi alamat domisili, atau alamat ktp');
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

        Schema::table('person_addresses', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('person')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('address_type_id')->references('id')->on('address_type')->cascadeOnUpdate()->cascadeOnDelete();
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
