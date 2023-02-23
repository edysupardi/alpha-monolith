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
        Schema::create('rawat_inap', function (Blueprint $table) {
            $table->comment('');
            $table->integer('trx_id', true);
            $table->integer('ruangan_id')->nullable();
            $table->string('no_rm', 8)->nullable();
            $table->integer('user_input')->nullable();
            $table->date('tgl_keluar')->nullable();
            $table->dateTime('tgl_kembali')->nullable();
            $table->integer('dokter')->nullable();
            $table->string('jenis_pembayaran', 100)->nullable();
            $table->integer('cara_masuk')->nullable();
            $table->string('cara_pulang', 50)->nullable();
            $table->text('aksi_tindakan')->nullable();
            $table->integer('user_id_batal')->nullable();
            $table->dateTime('tgl_batal')->nullable();
            $table->integer('user_id_analisis')->nullable();
            $table->dateTime('tgl_analisis')->nullable();
            $table->double('nilai_klpcm')->nullable();
            $table->double('nilai_klpcm_pertidok')->nullable();
            $table->enum('status', ['kembali', 'analisis'])->nullable();
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
        Schema::dropIfExists('rawat_inap');
    }
};
