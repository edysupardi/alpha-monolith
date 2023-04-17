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
        Schema::table('personal', function (Blueprint $table) {
            $table->foreign('created_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('updated_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('village_id')->references(['id'])->on('village')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('subdistrict_id')->references(['id'])->on('subdistrict')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('district_id')->references(['id'])->on('district')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('provience_id')->references(['id'])->on('provience')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('country_id')->references(['id'])->on('country')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('domicile_village_id')->references(['id'])->on('village')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('domicile_subdistrict_id')->references(['id'])->on('subdistrict')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('domicile_district_id')->references(['id'])->on('district')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('domicile_provience_id')->references(['id'])->on('provience')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('identity_id')->references(['id'])->on('identity_type')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('gender_id')->references(['id'])->on('gender')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('religion_id')->references(['id'])->on('religion')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('graduation_id')->references(['id'])->on('graduate')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('marital_status_id')->references(['id'])->on('marital')->onUpdate('CASCADE')->onDelete('set null');
            $table->foreign('deleted_by')->references(['id'])->on('user')->onUpdate('CASCADE')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal', function (Blueprint $table) {
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('updated_by');
            $table->dropConstrainedForeignId('village_id');
            $table->dropConstrainedForeignId('subdistrict_id');
            $table->dropConstrainedForeignId('district_id');
            $table->dropConstrainedForeignId('provience_id');
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('domicile_village_id');
            $table->dropConstrainedForeignId('domicile_subdistrict_id');
            $table->dropConstrainedForeignId('domicile_district_id');
            $table->dropConstrainedForeignId('domicile_provience_id');
            $table->dropConstrainedForeignId('identity_id');
            $table->dropConstrainedForeignId('gender_id');
            $table->dropConstrainedForeignId('religion_id');
            $table->dropConstrainedForeignId('graduation_id');
            $table->dropConstrainedForeignId('marital_status_id');
            $table->dropConstrainedForeignId('deleted_by');
        });
    }
};
