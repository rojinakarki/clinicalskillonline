<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile', function (Blueprint $table) {
            $table->increments('profile_id');
            $table->integer('users_id')->unsigned();
            $table->foreign('users_id')->references('id')->on('users');
            $table->string('profile_firstname');
            $table->string('profile_lastname');
            $table->string('profile_phonenumber');
            $table->integer('usergroup_id')->unsigned();
            $table->foreign('usergroup_id')->references('usergroup_id')->on('usergroup');
            $table->integer('org_id')->unsigned();
            $table->foreign('org_id')->references('org_id')->on('organization');
            $table->string('profile_paypalclient_id');
            $table->string('profile_paypalclientsecret');
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
        Schema::dropIfExists('profile');
    }
}
