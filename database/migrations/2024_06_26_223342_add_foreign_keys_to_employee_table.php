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
        Schema::table('employee', function (Blueprint $table) {
            $table->foreign(['company_id'], 'employee_ibfk_1')->references(['id'])->on('company')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['branch_id'], 'employee_ibfk_2')->references(['id'])->on('branch')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign(['person_id'], 'employee_ibfk_3')->references(['id'])->on('person')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['branch_id'], 'employee_ibfk_4')->references(['id'])->on('division_unit')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign('employee_ibfk_1');
            $table->dropForeign('employee_ibfk_2');
            $table->dropForeign('employee_ibfk_3');
            $table->dropForeign('employee_ibfk_4');
        });
    }
};
