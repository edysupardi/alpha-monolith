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
        Schema::create('personal', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('identity_id')->index()->nullable();
            $table->string('identity_number', 100)->nullable();
            $table->unsignedBigInteger('village_id')->index()->nullable();
            $table->unsignedInteger('subdistrict_id')->index()->nullable();
            $table->unsignedInteger('district_id')->index()->nullable();
            $table->unsignedInteger('provience_id')->index()->nullable();
            $table->unsignedInteger('country_id')->index()->nullable();
            $table->string('name', 225);
            $table->string('email')->nullable();
            $table->string('place_of_birth', 225)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('mother_name', 225)->nullable();
            $table->unsignedInteger('gender_id')->index()->nullable();
            $table->unsignedInteger('religion_id')->index()->nullable();
            $table->string('ethnic', 50)->nullable();
            $table->string('phone_number', 50)->nullable();
            $table->string('mobile_number', 50)->nullable();
            $table->unsignedBigInteger('domicile_village_id')->index()->nullable();
            $table->unsignedInteger('domicile_subdistrict_id')->index()->nullable();
            $table->unsignedInteger('domicile_district_id')->index()->nullable();
            $table->unsignedInteger('domicile_provience_id')->index()->nullable();
            $table->string('zip_code', 7)->nullable();
            $table->unsignedInteger('graduation_id')->index()->nullable();
            $table->string('education', 150)->nullable();
            $table->string('job', 125)->nullable();
            $table->unsignedInteger('marital_status_id')->index()->nullable();

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
        Schema::dropIfExists('personal');
    }
};
