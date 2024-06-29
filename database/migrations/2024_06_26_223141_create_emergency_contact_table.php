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
            $table->bigInteger('person_id', false)->nullable()->index()->on('person')->constrained()->cascadeOnDelete();
            $table->bigInteger('contact_id', false)->nullable()->index()->on('person')->constrained()->cascadeOnDelete();
            $table->integer('company_id', false)->nullable()->index()->on('company')->constrained()->cascadeOnDelete()->comment('ID dari perusahaan/PT/CV');
            $table->bigInteger('emergency_contact_type_id', false)->nullable()->index()->on('emergency_contact_type')->constrained()->cascadeOnDelete();
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
