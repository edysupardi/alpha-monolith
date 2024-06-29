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
        Schema::create('person', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('company_id', false)->nullable()->index()->on('company')->constrained()->cascadeOnDelete();
            $table->string('first_name', 255)->nullable();
            $table->string('last_name', 255)->nullable();
            $table->text('full_name')->nullable()->comment('gabungan dari first name dan last name, atau lgsg di isi tanpa melihat first & last name');
            $table->text('name_of_father')->nullable();
            $table->text('name_of_mother')->nullable();
            $table->string('place_of_birth', 255)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable()->comment('male (pria) or female (wanita)');
            $table->string('ethnic', 50)->nullable();
            $table->string('languages', 255)->nullable()->comment('mungkin secara default bisa di set indonesia');
            $table->integer('region_id', false)->nullable()->index()->on('region')->constrained()->cascadeOnDelete();
            $table->enum('marital_status', ['single', 'married', 'divorced', 'death_divorced'])->nullable()->default('single')->comment('pilihan: single, married, divorced (cerai hidup), death_divorce (cerai mati)');
            $table->string('last_education', 50)->nullable()->comment('pilihan: no_school, elementary_school');
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
        Schema::dropIfExists('person');
    }
};
