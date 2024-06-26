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
        Schema::create('identity_type', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id')->nullable()->index('company_id')->comment('ID dari perusahaan/PT/CV');
            $table->string('name', 255)->nullable();
            $table->boolean('status')->nullable()->default(true)->comment('0:inactive, 1:active');
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
        Schema::dropIfExists('identity_type');
    }
};
