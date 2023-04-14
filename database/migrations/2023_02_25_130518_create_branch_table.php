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
        Schema::create('branch', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id')->index();
            $table->string('name', 255);
            $table->string('phone_number', 50);
            $table->text('address');
            $table->unsignedInteger('village_id')->index();
            $table->unsignedInteger('subdistrict_id')->index();
            $table->unsignedInteger('district_id')->index();
            $table->unsignedInteger('provience_id')->index();
            $table->string('zip_code', 7);
            $table->boolean('is_main')->default(false);

            $table->unsignedBigInteger('created_by')->index()->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->unsignedBigInteger('updated_by')->index()->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
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
        Schema::dropIfExists('branch');
    }
};
