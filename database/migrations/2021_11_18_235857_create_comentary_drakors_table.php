<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentaryDrakorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentary_drakors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id');
            $table->foreignId('drakor_id');
            $table->string('komentator');
            $table->text('comentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentary_drakors');
    }
}
