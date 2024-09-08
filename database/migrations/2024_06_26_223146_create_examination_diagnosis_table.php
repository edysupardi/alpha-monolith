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
        Schema::create('examination_diagnosis', function (Blueprint $table) {
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV');
            $table->bigInteger('examination_id', false)->nullable()->index();
            $table->string('icd')->nullable()->index();
            $table->timestamp('created_at')->nullable();
        });

        Schema::table('examination_diagnosis', function (Blueprint $table) {
            $table->foreign('examination_id')->references('id')->on('examination')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('icd')->references('icd')->on('icd')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('company_id')->references('id')->on('company')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examination_diagnosis');
    }
};
