<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('films', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('rating',4,2)->nullable(); // 4 cislice max, 2 za des. ciarkou
            $table->integer('rating_num')->default('0');
            $table->year('year');
            $table->string('country');
            $table->integer('minutes');
            $table->mediumText('actors');
            $table->mediumText('desc');
            $table->string('trailer');
            $table->string('type');
            $table->string('image')->nullable();
            $table->string('image_big')->nullable();
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
        Schema::dropIfExists('films');
    }
}
