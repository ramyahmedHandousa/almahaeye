<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('age_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('age_id')->constrained('ages')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->unique(['age_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('age_translations');
    }
}
