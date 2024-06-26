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
        Schema::create('emergency_contact', function (Blueprint $table) {
            $table->integer('person_id')->nullable()->index('person_id');
            $table->integer('contact_id')->nullable()->index('contact_id');
            $table->integer('company_id')->nullable()->index('company_id')->comment('ID dari perusahaan/PT/CV');
            $table->integer('emergency_contact_type_id')->nullable()->index('emergency_contact_type_id');
            $table->dateTime('created_at')->nullable()->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_contact');
    }
};
