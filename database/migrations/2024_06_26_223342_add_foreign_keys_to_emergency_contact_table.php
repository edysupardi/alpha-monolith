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
        Schema::table('emergency_contact', function (Blueprint $table) {
            $table->foreign(['emergency_contact_type_id'], 'emergency_contact_ibfk_1')->references(['id'])->on('emergency_contact_type')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'emergency_contact_ibfk_2')->references(['id'])->on('person')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['contact_id'], 'emergency_contact_ibfk_3')->references(['id'])->on('person')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['company_id'], 'emergency_contact_ibfk_4')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('emergency_contact', function (Blueprint $table) {
            $table->dropForeign('emergency_contact_ibfk_1');
            $table->dropForeign('emergency_contact_ibfk_2');
            $table->dropForeign('emergency_contact_ibfk_3');
            $table->dropForeign('emergency_contact_ibfk_4');
        });
    }
};
