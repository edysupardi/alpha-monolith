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
        Schema::create('person_identity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV');
            $table->bigInteger('person_id', false)->nullable()->index();
            $table->string('identity_number', 50);
            $table->integer('identity_type_id', false)->nullable()->index();
            $table->string('identity_photo', 150)->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('person_identity', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('person_id')->references('id')->on('person')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('identity_type_id')->references('id')->on('identity_type')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('person_identity');
    }
};
