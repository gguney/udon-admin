<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            /*GENERAL FIELDS START*/
            $table->increments('id');
            /*

            $table->dateTime('created_at')->default(DB::raw('CURRENT_TIMESTAMP(0)'));
            $table->integer('created_user_id')->unsigned();
            $table->boolean('is_modified')->default('false');
            $table->dateTime('modified_at')->nullable();
            $table->integer('modified_user_id')->unsigned()->nullable();
            $table->boolean('is_deleted')->default('false');
            $table->dateTime('deleted_at')->nullable();
            $table->integer('deleted_user_id')->unsigned()->nullable();
            $table->boolean('is_versioned')->default('false');
            $table->integer('version')->unsigned();
            $table->integer('parent_id')->unsigned();
            /*GENERAL FIELDS END*/
            $table->string('file_name')->nullable();
            $table->integer('ref_id');
            $table->string('type_name', 50);
            $table->string('path');
            $table->boolean('is_default');
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
        Schema::drop('files');
    }
}
