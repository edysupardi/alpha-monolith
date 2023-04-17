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
        Schema::create('user', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id')->index()->nullable();
            $table->unsignedInteger('branch_id')->index()->nullable();
            $table->unsignedBigInteger('personal_id')->index()->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->default('0')->comment('0:inactive, 1:waiting-activation, 2:active');
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->unsignedBigInteger('deleted_by')->nullable()->index();
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
        Schema::dropIfExists('user');
    }
};
