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
        Schema::table('icd', function (Blueprint $table) {
            $table->foreign(['parent_id'], 'icd_ibfk_1')->references(['id'])->on('icd')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['company_id'], 'icd_ibfk_2')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('icd', function (Blueprint $table) {
            $table->dropForeign('icd_ibfk_1');
            $table->dropForeign('icd_ibfk_2');
        });
    }
};
