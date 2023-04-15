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
            $table->bigIncrements('id');
            $table->unsignedInteger('company_id')->index()->nullable();
            $table->unsignedInteger('branch_id')->index()->nullable();
            $table->string('name', 225);
            $table->unsignedBigInteger('created_by')->nullable()->index();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->unsignedBigInteger('updated_by')->nullable()->index();
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
        Schema::dropIfExists('poly');
    }
};
