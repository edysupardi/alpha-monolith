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
        Schema::create('icd', function (Blueprint $table) {
            $table->bigInteger('id', true);
            $table->integer('company_id')->nullable()->index('icd_index_4')->comment('ID dari perusahaan/PT/CV');
            $table->bigInteger('parent_id')->nullable()->index('parent_id');
            $table->string('code', 10)->nullable();
            $table->string('name', 255)->nullable();
            $table->string('group', 50)->nullable();
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
        Schema::dropIfExists('icd');
    }
};
