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
        Schema::create('village', function (Blueprint $table) {
            $table->uuid('id', 36)->primary()->unique();
            $table->uuid('subdistrict_id', 36)->index();
            $table->uuid('district_id', 36)->index();
            $table->uuid('provience_id', 36)->index();
            $table->string('name', 255);
            $table->double('latitude', 15, 8)->nullable();
            $table->double('longitude', 15, 8)->nullable();

            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('village', function (Blueprint $table) {
            $table->foreign('subdistrict_id')->references(['id'])->on('subdistrict')->onUpdate('CASCADE');
            $table->foreign('district_id')->references(['id'])->on('district')->onUpdate('CASCADE');
            $table->foreign('provience_id')->references(['id'])->on('provience')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('village');
    }
};
