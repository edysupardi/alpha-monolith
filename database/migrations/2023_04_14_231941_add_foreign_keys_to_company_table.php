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
        Schema::table('company', function (Blueprint $table) {
            $table->foreign('village_id')->references(['id'])->on('village')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('subdistrict_id')->references(['id'])->on('subdistrict')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('district_id')->references(['id'])->on('district')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('provience_id')->references(['id'])->on('provience')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('created_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('updated_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('company', function (Blueprint $table) {
            $table->dropConstrainedForeignId('village_id');
            $table->dropConstrainedForeignId('subdistrict_id');
            $table->dropConstrainedForeignId('district_id');
            $table->dropConstrainedForeignId('provience_id');
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
        });
    }
};
