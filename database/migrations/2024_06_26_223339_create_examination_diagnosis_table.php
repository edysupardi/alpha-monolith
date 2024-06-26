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
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('examination_diagnosis_index_9')->comment('ID dari perusahaan/PT/CV');
            $table->bigInteger('examination_id')->nullable()->index('examination_diagnosis_index_10');
            $table->bigInteger('icd_id')->nullable()->index('icd_id');
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
