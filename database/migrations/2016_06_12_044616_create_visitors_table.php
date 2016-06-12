<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('provider', 50)->index()->nullable();
            $table->integer('provider_user_id')->unsigned()->nullable();
            $table->string('nickname', 50)->nullable();
            $table->string('name', 75)->nullable();
            $table->string('email', 75)->nullable()->unique();
            $table->string('avatar', 150)->nullable();
            $table->enum('active', ['Y', 'N'])->default('Y');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('visitors');
    }
}
