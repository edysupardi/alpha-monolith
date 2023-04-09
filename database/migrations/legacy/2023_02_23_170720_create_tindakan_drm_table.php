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
        Schema::create('tindakan_drm', function (Blueprint $table) {
            $table->comment('');
            $table->integer('tindakan_id', true);
            $table->string('nama', 50)->nullable();
            $table->string('label', 200)->nullable();
            $table->integer('group_form')->nullable();
            $table->integer('ruang_id')->nullable();
            $table->enum('analisis_field', ['ya', 'tidak'])->nullable()->default('tidak');
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
        Schema::dropIfExists('tindakan_drm');
    }
};
