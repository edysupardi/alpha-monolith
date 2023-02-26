<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('analisis', function (Blueprint $table) {
            $table->comment('');
            $table->integer('analisis_id', true);
            $table->integer('trx_id')->nullable();
            $table->string('no_rm', 8)->nullable();
            $table->integer('form_id')->nullable();
            $table->string('form_no', 15)->nullable();
            $table->string('form_nama', 200)->nullable();
            $table->string('source', 200)->nullable();
            $table->enum('isian', ['lengkap', 'tidak lengkap'])->nullable();
            $table->enum('bacaan', ['terbaca', 'tidak terbaca'])->nullable();
            $table->enum('autentifikasi', ['lengkap', 'tidak lengkap'])->nullable();
            $table->enum('waktu', ['lengkap', 'tidak lengkap'])->nullable();
            $table->double('nilai', 11, 0)->nullable();
            $table->dateTime('analisis_time')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('analisis');
    }
};
