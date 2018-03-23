<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLessonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->increments('lesson_id');
            $table->integer('order');
            $table->integer('course_id')->unsigned();
            $table->foreign('course_id')->references('course_id')->on('course');
            $table->string('lesson_title');
            $table->string('lesson_description')->nullable();
            $table->string('lesson_image')->nullable();
            $table->string('lesson_video')->nullable();
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
        Schema::dropIfExists('lesson');
    }
}
