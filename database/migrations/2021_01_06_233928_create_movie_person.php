<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviePerson extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movie_person', function (Blueprint $table) {
            $table->id();
            $table->foreignId('movie_id')
                ->constrained();
            $table->foreignId('person_id')
                ->constrained();
            $table->integer('person_role')->default(0);
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
        Schema::dropIfExists('movie_person');
    }
}
