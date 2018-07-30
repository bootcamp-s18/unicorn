<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedinteger('creator_id');
            $table->foreign('creator_id')->references('id')->on('users');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('organization')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('work_email')->nullable();
            $table->bigInteger('home_phone')->nullable();
            $table->bigInteger('work_phone')->nullable();
            $table->bigInteger('cell_phone')->nullable();
            $table->string('address')->nullable();
            $table->dateTime('birth_date')->nullable();
            $table->binary('image')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('contacts');
    }
}
