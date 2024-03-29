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
            $table->uuid('id', 36)->primary();
            $table->uuid('company_id', 36)->index();
            $table->uuid('branch_id', 36)->index();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->tinyInteger('status')->default('0')->comment('0:inactive, 1:waiting-activation, 2:active');
            $table->uuid('created_by', 36)->nullable()->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->uuid('updated_by', 36)->nullable()->index();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
            $table->unique(['id'], 'unique');
        });

        Schema::table('user', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->onUpdate('CASCADE');
            $table->foreign('branch_id')->references('id')->on('branch')->onUpdate('CASCADE');
            $table->foreign('created_by')->references(['id'])->on('user')->onUpdate('CASCADE');
            $table->foreign('updated_by')->references(['id'])->on('user')->onUpdate('CASCADE');
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
