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
        Schema::create('rawat_jalan', function (Blueprint $table) {
            $table->comment('');
            $table->integer('trx_id', true);
            $table->integer('poli_id')->nullable();
            $table->string('no_rm', 8)->nullable();
            $table->integer('user_id_keluar')->nullable();
            $table->dateTime('tgl_keluar')->nullable();
            $table->integer('user_id_kembali')->nullable();
            $table->dateTime('tgl_kembali')->nullable();
            $table->integer('user_id_batal')->nullable();
            $table->dateTime('tgl_batal')->nullable();
            $table->enum('status', ['keluar', 'kembali', 'batal'])->nullable();
            $table->text('keterangan')->nullable();
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
        Schema::dropIfExists('rawat_jalan');
    }
};
