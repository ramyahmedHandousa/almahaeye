<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameShapTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_shap_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frame_shap_id')->constrained('frame_shaps')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->unique(['frame_shap_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frame_shap_translations');
    }
}
