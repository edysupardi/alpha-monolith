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
        Schema::table('branch_polygon', function (Blueprint $table) {
            $table->foreign(['branch_id'], 'branch_polygon_ibfk_1')->references(['id'])->on('branch')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branch_polygon', function (Blueprint $table) {
            $table->dropForeign('branch_polygon_ibfk_1');
        });
    }
};
