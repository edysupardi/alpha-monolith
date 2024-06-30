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
        Schema::create('employee', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV')->references('id')->on('company')->constrained()->cascadeOnDelete();
            $table->integer('branch_id', false)->nullable()->index()->comment('ID cabang dari si perusahaan')->references('id')->on('branch')->constrained()->cascadeOnDelete();
            $table->integer('division_unit_id', false)->nullable()->comment('ID divisi/unit/instalasi dari si cabang perusahaan')->references('id')->on('division_unit')->constrained()->cascadeOnDelete();
            $table->bigInteger('person_id', false)->nullable()->index()->comment('ID dari orang nya')->references('id')->on('person')->constrained()->cascadeOnDelete();
            $table->string('employee_number', 50)->nullable()->comment('Nomor Induk Karyawan/NIK');
            $table->string('phone', 30)->nullable()->comment('no hp, optional');
            $table->text('address')->nullable();
            $table->string('email', 150)->nullable()->comment('optional');
            $table->string('username', 150)->nullable()->comment('bisa menggunakan email jika tidak punya username');
            $table->string('password', 200)->nullable()->comment('encryption bcrypt');
            $table->boolean('status')->nullable()->default(true)->comment('0:inactive, 1:active');
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
        Schema::dropIfExists('employee');
    }
};
