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
            $table->foreign(['company_id'], 'division_unit_ibfk_1')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['parent_id'], 'division_unit_ibfk_2')->references(['id'])->on('division_unit')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['branch_id'], 'division_unit_ibfk_3')->references(['id'])->on('branch')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('division_unit', function (Blueprint $table) {
            $table->dropForeign('division_unit_ibfk_1');
            $table->dropForeign('division_unit_ibfk_2');
            $table->dropForeign('division_unit_ibfk_3');
        });
    }
};
