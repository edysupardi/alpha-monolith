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
        Schema::create('emergency_contact', function (Blueprint $table) {
            $table->bigInteger('person_id', false)->nullable()->index();
            $table->bigInteger('contact_id', false)->nullable()->index();
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV');
            $table->integer('emergency_contact_type_id', false)->nullable()->index();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('emergency_contact', function (Blueprint $table) {
            $table->foreign('person_id')->references('id')->on('person')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('contact_id')->references('id')->on('person')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('emergency_contact_type_id')->references('id')->on('emergency_contact_type')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contact');
    }
};
