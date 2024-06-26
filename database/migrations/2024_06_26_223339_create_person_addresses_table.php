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
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('company_id')->comment('ID dari perusahaan/PT/CV');
            $table->integer('person_id')->nullable()->index('person_id');
            $table->integer('address_type_id')->nullable()->index('address_type_id')->comment('bisa jadi alamat domisili, atau alamat ktp');
            $table->text('address')->nullable();
            $table->tinyInteger('rt')->nullable();
            $table->tinyInteger('rw')->nullable();
            $table->integer('village_id')->nullable();
            $table->integer('subdistrict_id')->nullable();
            $table->integer('regency_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('country_id')->nullable();
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
