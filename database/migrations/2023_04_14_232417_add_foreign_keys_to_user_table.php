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
        Schema::table('user', function (Blueprint $table) {
            $table->foreign('personal_id')->references(['id'])->on('personal')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('company_id')->references('id')->on('company')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('branch_id')->references('id')->on('branch')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('created_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('updated_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('deleted_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropConstrainedForeignId('personal_id');
            $table->dropConstrainedForeignId('company_id');
            $table->dropConstrainedForeignId('branch_id');
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
            $table->dropConstrainedForeignId('deleted_by');
        });
    }
};
