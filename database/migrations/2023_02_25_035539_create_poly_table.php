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
        Schema::create('poly', function (Blueprint $table) {
            $table->uuid('id', 36)->primary()->unique();
            $table->string('name', 225);
            $table->uuid('created_by', 36)->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->uuid('updated_by', 36)->index();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('poly', function (Blueprint $table) {
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
        Schema::dropIfExists('poly');
    }
};
