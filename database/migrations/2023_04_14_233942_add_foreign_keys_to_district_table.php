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
        Schema::table('district', function (Blueprint $table) {
            $table->foreign('provience_id')->references(['id'])->on('provience')->onUpdate('CASCADE')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('district', function (Blueprint $table) {
            $table->dropConstrainedForeignId('provience_id');
        });
    }
};
