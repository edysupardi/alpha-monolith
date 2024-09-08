<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('branch', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id', false)->nullable()->index();
            $table->string('name', 255)->nullable()->comment('name of branch');
            $table->string('phone', 30)->nullable()->comment('can be same with phone of PT/CV');
            $table->text('address')->nullable()->comment('can be same with phone of PT/CV');
            $table->boolean('status')->nullable()->default(true)->comment('0:inactive, 1:active');
            $table->boolean('main_branch')->nullable()->default(false)->comment('0:not_main, 1:is_main');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('branch', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch');
    }
};
