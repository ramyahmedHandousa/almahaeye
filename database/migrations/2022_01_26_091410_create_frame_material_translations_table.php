<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrameMaterialTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('frame_material_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('frame_material_id')->constrained('frame_materials')->cascadeOnDelete();
            $table->string('locale');
            $table->string('name');
            $table->unique(['frame_material_id','locale']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('frame_material_translations');
    }
}
