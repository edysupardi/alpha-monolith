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
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id')->index()->nullable();
            $table->unsignedInteger('branch_id')->index()->nullable();
            $table->unsignedBigInteger('personal_id')->index()->nullable();
            $table->string('medical_number', 10)->index()->nullable();

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
        Schema::dropIfExists('patient');
    }
};
