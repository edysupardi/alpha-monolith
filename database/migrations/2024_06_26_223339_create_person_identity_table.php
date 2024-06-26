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
        Schema::create('person_identity', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('company_id')->comment('ID dari perusahaan/PT/CV');
            $table->integer('person_id')->nullable()->index('person_id');
            $table->string('identity_number', 50)->nullable();
            $table->integer('identity_type_id')->nullable()->index('identity_type_id');
            $table->string('identity_photo', 150)->nullable();
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
        Schema::dropIfExists('person_identity');
    }
};
