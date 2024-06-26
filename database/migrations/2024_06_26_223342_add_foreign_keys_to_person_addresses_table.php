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
        Schema::table('person_addresses', function (Blueprint $table) {
            $table->foreign(['address_type_id'], 'person_addresses_ibfk_1')->references(['id'])->on('address_type')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['person_id'], 'person_addresses_ibfk_2')->references(['id'])->on('person')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['company_id'], 'person_addresses_ibfk_3')->references(['id'])->on('company')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('person_addresses', function (Blueprint $table) {
            $table->dropForeign('person_addresses_ibfk_1');
            $table->dropForeign('person_addresses_ibfk_2');
            $table->dropForeign('person_addresses_ibfk_3');
        });
    }
};
