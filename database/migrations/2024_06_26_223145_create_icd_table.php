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
        Schema::create('icd', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->string('icd', 10)->primary();
            $table->integer('company_id', false)->nullable()->index();
            $table->string('parent_id')->nullable()->index();
            $table->string('name', 255);
            $table->string('group', 50)->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('icd', function (Blueprint $table) {
            $table->foreign('parent_id')->references(['icd'])->on('icd')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('icd');
    }
};
