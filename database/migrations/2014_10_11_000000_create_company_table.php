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
            $table->uuid('id', 36)->primary()->unique();
            $table->string('name', 255);
            $table->string('phone_number', 50);
            $table->text('address');
            $table->uuid('village_id', 36)->index();
            $table->uuid('subdistrict_id', 36)->index();
            $table->uuid('district_id', 36)->index();
            $table->uuid('provience_id', 36)->index();
            $table->string('zip_code', 7);

            $table->uuid('created_by', 36)->index()->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->uuid('updated_by', 36)->index()->nullable();
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
        Schema::dropIfExists('company');
    }
};
