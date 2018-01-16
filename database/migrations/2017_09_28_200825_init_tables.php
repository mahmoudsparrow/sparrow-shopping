<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('phone');
            $table->string('address');
            $table->rememberToken();
            $table->timestamps();
        });



        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email');
            $table->string('token');
//            $table->timestamps();
            $table->timestamp('created_at');
        });
//
//
//        Schema::create('paintings', function (Blueprint $thePainting){
//            $thePainting->increments('id');
//            $thePainting->string('title');
//            $thePainting->string('artist');
//            $thePainting->integer('year');
//            $thePainting->integer('user_id')->unsigned();
//            $thePainting->foreign('user_id')->references('id')->on('users');
//            $thePainting->timestamps();
//        });
//
//        Schema::create('articles', function (Blueprint $theArticle){
//            $theArticle->increments('id');
//            $theArticle->string('title');
//            $theArticle->string('body');
//            $theArticle->integer('user_id')->unsigned();
//            $theArticle->foreign('user_id')->references('id')->on('users');
//            $theArticle->timestamps();
//        });
//
//        Schema::create('comments', function (Blueprint $theComment){
//            $theComment->increments('id');
//            $theComment->string('comment');
//            $theComment->integer('article_id')->unsigned();
//            $theComment->foreign('article_id')->references('id')->on('articles');
//            $theComment->timestamps();
//        });

        Schema::create('product', function (Blueprint $theProduct){
            $theProduct->increments('id');
            $theProduct->string('title');
            $theProduct->text('imagePath');
            $theProduct->text('description');
            $theProduct->float('price');
            $theProduct->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
