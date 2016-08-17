<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('managements', function (Blueprint $table) {
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
            $table->integer('ref_owner_id')->unsigned();
            $table->foreign('ref_owner_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('brand_name', 250);
            $table->string('company_name', 250);
            $table->string('tax_number', 250);
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['company_name', 'tax_number']);


        });
        Schema::create('menus', function (Blueprint $table) {
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
            $table->integer('ref_management_id')->unsigned();
            $table->foreign('ref_management_id')->references('id')->on('managements')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 250);
            $table->string('description', 250)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('categories', function (Blueprint $table) {
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
            $table->integer('ref_menu_id')->unsigned();
            $table->foreign('ref_menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 250);
            $table->string('description', 250)->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('foods', function (Blueprint $table) {
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
            $table->integer('ref_category_id')->unsigned();
            $table->foreign('ref_category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 250);
            $table->string('description', 250)->nullable();
            $table->softDeletes();
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
        Schema::drop('foods');
        Schema::drop('categories');
        Schema::drop('menus');
        Schema::drop('managements');
    }
}
