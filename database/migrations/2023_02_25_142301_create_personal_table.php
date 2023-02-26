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
            $table->uuid('id', 36)->primary()->unique();
            $table->uuid('identity_id', 36);
            $table->string('identity_number', 100);
            $table->uuid('village_id', 36)->index();
            $table->uuid('subdistrict_id', 36)->index();
            $table->uuid('district_id', 36)->index();
            $table->uuid('provience_id', 36)->index();
            $table->uuid('country_id', 36)->index();
            $table->string('name', 225);
            $table->string('place_of_birth', 225);
            $table->date('date_of_birth');
            $table->string('mother_name', 225);
            $table->uuid('gender_id', 36);
            $table->uuid('religion_id', 36);
            $table->string('ethnic', 50);
            $table->string('phone_number', 50);
            $table->string('mobile_number', 50);
            $table->uuid('domicile_village_id', 36)->index();
            $table->uuid('domicile_subdistrict_id', 36)->index();
            $table->uuid('domicile_district_id', 36)->index();
            $table->uuid('domicile_provience_id', 36)->index();
            $table->string('zip_code', 7);
            $table->uuid('graduation_id', 36);
            $table->string('education', 150);
            $table->string('job', 125);
            $table->uuid('marital_status_id', 36);

            $table->uuid('created_by', 36)->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->uuid('updated_by', 36)->index();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('personal', function (Blueprint $table) {
            $table->foreign('created_by')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('village_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('subdistrict_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('district_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('provience_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('country_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('domicile_village_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('domicile_subdistrict_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('domicile_district_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('domicile_provience_id')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('identity_id')->references(['id'])->on('identity_type')->onUpdate('CASCADE');
            $table->foreign('gender_id')->references(['id'])->on('gender')->onUpdate('CASCADE');
            $table->foreign('religion_id')->references(['id'])->on('religion')->onUpdate('CASCADE');
            $table->foreign('graduation_id')->references(['id'])->on('graduate')->onUpdate('CASCADE');
            $table->foreign('marital_status_id')->references(['id'])->on('marital')->onUpdate('CASCADE');
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
