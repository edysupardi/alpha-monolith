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
        Schema::table('emergency_contact_type', function (Blueprint $table) {
            $table->foreign(['company_id'], 'emergency_contact_type_ibfk_1')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_contact_type', function (Blueprint $table) {
            $table->dropForeign('emergency_contact_type_ibfk_1');
        });
    }
};
