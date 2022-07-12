<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenresFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genres__films', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('genres_id')->constrained('genres'); //foreignId('genres_id');
            $table->foreignId('films_id')->constrained('films'); //foreignId('films_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('genres__films');
    }
}
