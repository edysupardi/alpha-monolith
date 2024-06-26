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
        Schema::table('work_present', function (Blueprint $table) {
            $table->foreign(['company_id'], 'work_present_ibfk_1')->references(['id'])->on('company')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['branch_id'], 'work_present_ibfk_2')->references(['id'])->on('branch')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['employee_id'], 'work_present_ibfk_3')->references(['id'])->on('employee')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['schedule_id'], 'work_present_ibfk_4')->references(['id'])->on('work_schedule')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_present', function (Blueprint $table) {
            $table->dropForeign('work_present_ibfk_1');
            $table->dropForeign('work_present_ibfk_2');
            $table->dropForeign('work_present_ibfk_3');
            $table->dropForeign('work_present_ibfk_4');
        });
    }
};
