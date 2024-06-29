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
            $table->integer('company_id', false)->nullable()->index()->comment('ID dari perusahaan/PT/CV')->on('company')->constrained()->cascadeOnDelete();
            $table->bigInteger('examination_id', false)->nullable()->index()->on('examination')->constrained()->cascadeOnDelete();
            $table->string('icd')->nullable()->index()->on('icd')->constrained()->cascadeOnDelete();
            $table->timestamp('created_at')->nullable();
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
