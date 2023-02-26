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
        Schema::create('patient', function (Blueprint $table) {
            $table->uuid('id', 36)->primary()->unique();
            $table->uuid('company_id', 36)->index();
            $table->uuid('branch_id', 36)->index();
            $table->uuid('personal_id', 36)->index();
            $table->string('medical_number', 10)->index();

            $table->uuid('created_by', 36)->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->uuid('updated_by', 36)->index();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('patient', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->onUpdate('CASCADE');
            $table->foreign('branch_id')->references('id')->on('branch')->onUpdate('CASCADE');
            $table->foreign('created_by')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('personal_id')->references(['id'])->on('personal')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient');
    }
};
