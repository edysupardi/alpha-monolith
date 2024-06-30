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
        Schema::create('branch_polygon', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('branch_id', false)->index();
            $table->double('latitude')->nullable()->comment('lat dari posisi kantor per branch');
            $table->double('longitude')->nullable()->comment('lng dari posisi kantor per branch');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->useCurrentOnUpdate()->useCurrent();
            $table->softDeletes();
        });

        Schema::table('branch_polygon', function (Blueprint $table) {
            $table->foreign('branch_id')->references('id')->on('branch')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_polygon');
    }
};
