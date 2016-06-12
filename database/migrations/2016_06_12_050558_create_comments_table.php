<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visitor_id')->unsigned()->index()->nullable();
            $table->integer('article_id')->unsigned()->index();
            $table->string('title', 255);
            $table->text('details')->nullable();
            $table->enum('display', ['Y', 'N'])->default('N');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('visitor_id')->references('id')->on('visitors')->onDelete('set null');
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
