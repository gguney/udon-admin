<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientContentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            /*GENERAL FIELDS START*/
            $table->increments('id');
//            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
//            $table->integer('created_user_id')->unsigned();
//            $table->boolean('is_modified')->default('false');
//            $table->dateTime('modified_at')->nullable();
//            $table->integer('modified_user_id')->unsigned()->nullable();
//            $table->boolean('is_deleted')->default('false');
//            $table->dateTime('deleted_at')->nullable();
//            $table->integer('deleted_user_id')->unsigned()->nullable();
//            $table->boolean('is_versioned')->default('false');
//            $table->integer('version')->unsigned();
//            $table->integer('parent_id')->unsigned();
            /*GENERAL FIELDS END*/
            $table->string('name')->unique();
            $table->string('description')->unsigned();
            $table->timestamps();
        });
        Schema::create('contents', function (Blueprint $table) {
            /*GENERAL FIELDS START*/
            $table->increments('id');
//            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
//            $table->integer('created_user_id')->unsigned();
//            $table->boolean('is_modified')->default('false');
//            $table->dateTime('modified_at')->nullable();
//            $table->integer('modified_user_id')->unsigned()->nullable();
//            $table->boolean('is_deleted')->default('false');
//            $table->dateTime('deleted_at')->nullable();
//            $table->integer('deleted_user_id')->unsigned()->nullable();
//            $table->boolean('is_versioned')->default('false');
//            $table->integer('version')->unsigned();
//            $table->integer('parent_id')->unsigned();
            /*GENERAL FIELDS END*/
            $table->string('name')->unique();
            $table->string('description')->unsigned();
            $table->timestamps();

        });

        Schema::create('foods-contents', function (Blueprint $table) {
            /*GENERAL FIELDS START*/
            $table->increments('id');
//            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
//            $table->integer('created_user_id')->unsigned();
//            $table->boolean('is_modified')->default('false');
//            $table->dateTime('modified_at')->nullable();
//            $table->integer('modified_user_id')->unsigned()->nullable();
//            $table->boolean('is_deleted')->default('false');
//            $table->dateTime('deleted_at')->nullable();
//            $table->integer('deleted_user_id')->unsigned()->nullable();
//            $table->boolean('is_versioned')->default('false');
//            $table->integer('version')->unsigned();
//            $table->integer('parent_id')->unsigned();
            /*GENERAL FIELDS END*/
            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('content_id')->unsigned();
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::create('foods-ingredients', function (Blueprint $table) {
            /*GENERAL FIELDS START*/
            $table->increments('id');
//            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
//            $table->integer('created_user_id')->unsigned();
//            $table->boolean('is_modified')->default('false');
//            $table->dateTime('modified_at')->nullable();
//            $table->integer('modified_user_id')->unsigned()->nullable();
//            $table->boolean('is_deleted')->default('false');
//            $table->dateTime('deleted_at')->nullable();
//            $table->integer('deleted_user_id')->unsigned()->nullable();
//            $table->boolean('is_versioned')->default('false');
//            $table->integer('version')->unsigned();
//            $table->integer('parent_id')->unsigned();
            /*GENERAL FIELDS END*/
            $table->integer('food_id')->unsigned();
            $table->foreign('food_id')->references('id')->on('foods')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('ingredient_id')->unsigned();
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('foods-ingredients');
        Schema::drop('foods-contents');
        Schema::drop('ingredients');
        Schema::drop('foods');
    }
}
