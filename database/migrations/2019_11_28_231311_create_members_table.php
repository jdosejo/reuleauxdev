<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('middlename')->nullable();
            $table->integer('age')->nullable();
            $table->string('birthdate')->nullable();
            $table->text('address')->nullable();
            $table->string('status')->nullable();
            $table->integer('classification_id')->nullable();
            $table->integer('branch_id')->nullable();
            $table->string('contact')->nullable();
            $table->string('picture')->nullable();
            $table->string('password')->nullable();
            $table->string('username')->nullable();
            $table->string('signature')->nullable();
            $table->string('access_token')->nullable();
            $table->string('remember_token')->nullable();
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
        Schema::dropIfExists('members');
    }
}
