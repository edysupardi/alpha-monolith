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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('company_id')->nullable()->index()->comment('ID dari perusahaan/PT/CV')->on('company')->constrained()->cascadeOnDelete();
            $table->bigInteger('person_id')->nullable()->index()->on('person')->constrained()->cascadeOnDelete();
            $table->string('username')->comment('unique username for same of company ID');
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->nullable()->default('active');
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
        Schema::dropIfExists('users');
    }
};
