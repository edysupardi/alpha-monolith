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
            $table->bigInteger('id', true)->primary();
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV');
            $table->integer('branch_id', false)->nullable()->index()->comment('ID cabang dari si perusahaan');
            $table->integer('division_unit_id', false)->nullable()->comment('ID divisi/unit/instalasi dari si cabang perusahaan');
            $table->bigInteger('person_id', false)->nullable()->index()->comment('ID dari orang nya');
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

        Schema::table('employee', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('person_id')->references('id')->on('person')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('division_unit_id')->references('id')->on('division_unit')->cascadeOnUpdate()->cascadeOnDelete();
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
