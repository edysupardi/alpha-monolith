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
        Schema::table('division_unit', function (Blueprint $table) {
            $table->dropConstrainedForeignId('branch_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('division_unit', function (Blueprint $table) {
            $table->integer('branch_id', false)->index();
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->nullOnDelete();
        });
    }
};
