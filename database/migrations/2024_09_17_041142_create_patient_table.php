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
        Schema::table('patient', function (Blueprint $table) {
            $table->bigInteger('created_by', false)->nullable()->index()->comment('ID dari orang yang create')->after('created_at');
            $table->bigInteger('updated_by', false)->nullable()->index()->comment('ID dari orang yang update terakhir')->after('updated_at');
            $table->bigInteger('deleted_by', false)->nullable()->index()->comment('ID dari orang yang ngapus terakhir')->after('deleted_at');
        });

        Schema::table('patient', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('person')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('updated_by')->references('id')->on('person')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('deleted_by')->references('id')->on('person')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
            $table->dropConstrainedForeignId('deleted_by');
        });
    }
};
