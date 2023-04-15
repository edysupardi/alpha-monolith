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
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->string('name', 255);
            $table->string('phone_number', 50);
            $table->text('address');
            $table->unsignedBigInteger('village_id')->index()->nullable();
            $table->unsignedInteger('subdistrict_id')->index()->nullable();
            $table->unsignedInteger('district_id')->index()->nullable();
            $table->unsignedInteger('provience_id')->index()->nullable();
            $table->string('zip_code', 7);

            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->unsignedBigInteger('deleted_by')->index()->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
};
