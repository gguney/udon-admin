<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/*

Command                     	Description
$table->bigIncrements('id');	Incrementing ID (primary key) using a "UNSIGNED BIG INTEGER" equivalent.
$table->bigInteger('votes');	BIGINT equivalent for the database.
$table->binary('data');	BLOB equivalent for the database.
$table->boolean('confirmed');	BOOLEAN equivalent for the database.
$table->char('name', 4);	CHAR equivalent with a length.
$table->date('created_at');	DATE equivalent for the database.
$table->dateTime('created_at');	DATETIME equivalent for the database.
$table->decimal('amount', 5, 2);	DECIMAL equivalent with a precision and scale.
$table->double('column', 15, 8);	DOUBLE equivalent with precision, 15 digits in total and 8 after the decimal point.
$table->enum('choices', ['foo', 'bar']);	ENUM equivalent for the database.
$table->float('amount');	FLOAT equivalent for the database.
$table->increments('id');	Incrementing ID (primary key) using a "UNSIGNED INTEGER" equivalent.
$table->integer('votes');	INTEGER equivalent for the database.
$table->json('options');	JSON equivalent for the database.
$table->jsonb('options');	JSONB equivalent for the database.
$table->longText('description');	LONGTEXT equivalent for the database.
$table->mediumInteger('numbers');	MEDIUMINT equivalent for the database.
$table->mediumText('description');	MEDIUMTEXT equivalent for the database.
$table->morphs('taggable');	Adds INTEGER taggable_id and STRING taggable_type.
$table->nullableTimestamps();	Same as timestamps(), except allows NULLs.
$table->rememberToken();	Adds remember_token as VARCHAR(100) NULL.
$table->smallInteger('votes');	SMALLINT equivalent for the database.
$table->softDeletes();	Adds deleted_at column for soft deletes.
$table->string('email');	VARCHAR equivalent column.
$table->string('name', 100);	VARCHAR equivalent with a length.
$table->text('description');	TEXT equivalent for the database.
$table->time('sunrise');	TIME equivalent for the database.
$table->tinyInteger('numbers');	TINYINT equivalent for the database.
$table->timestamp('added_on');	TIMESTAMP equivalent for the database.
$table->timestamps();	Adds created_at and updated_at columns.
$table->uuid('id');	UUID equivalent for the database


Modifier	Description
->first()	Place the column "first" in the table (MySQL Only)
->after('column')	Place the column "after" another column (MySQL Only)
->nullable()	Allow NULL values to be inserted into the column
->default($value)	Specify a "default" value for the column
->unsigned()	Set integer columns to UNSIGNED

Command	Description
$table->primary('id');	Add a primary key.
$table->primary(['first', 'last']);	Add composite keys.
$table->unique('email');	Add a unique index.
$table->index('state');	Add a basic index.

$table->date('app_date')->default(DB::raw('CURRENT_TIMESTAMP'));

        $table->foreign('project_id')->references('id')->on('projects');

php artisan make:migration create_users_table

php artisan make:migration add_votes_to_users_table --table=users
php artisan make:migration create_users_table --create=users

 */
class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            /*GENERAL FIELDS START*/
            $table->increments('id');



            /*
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
            $table->string('username')->unique();
            $table->string('email',255)->unique();
            $table->string('password', 60);
            $table->rememberToken()->nullable();
            $table->softDeletes();
            $table->timestamps();

            /*
            $table->string('first_name',100);
            $table->string('last_name',100);*/
            /*
            $table->integer('ref_gender_id')->unsigned();
            $table->date('date_of_birth');
            $table->string('phone_number_1',10);
            $table->string('phone_number_2',10)->nullable();
            $table->text('address');
            $table->integer('ref_country_id')->unsigned();
            $table->integer('ref_city_id')->unsigned();
            $table->integer('ref_region_id')->unsigned();
            $table->string('postal_code',5);
            $table->smallInteger('max_restaurant_count');*/
        });

        Schema::create('roles', function (Blueprint $table) {
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
            //$table->integer('parent_id')->unsigned();
            /*GENERAL FIELDS END*/
            $table->string('name',100)->unique();
            $table->string('description',255)->nullable();
            $table->timestamps();


        });

        Schema::create('users-roles', function (Blueprint $table) {
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
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('role_id')->unsigned();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');


        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users-roles');
        Schema::drop('roles');
        Schema::drop('users');
    }
}