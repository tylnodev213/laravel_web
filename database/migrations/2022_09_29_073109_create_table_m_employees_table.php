<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->unsigned();
            $table->string('email',128);
            $table->string('first_name',128);
            $table->string('last_name',128);
            $table->string('password',64);
            $table->char('gender', 1)->comment('1/Male 2/Female');
            $table->date('birthday');
            $table->string('address',256);
            $table->string('avatar',128);
            $table->integer('salary');
            $table->char('position', 1)->comment('1/ Manager 2/ Team leader 3/ BSE 4/ Dev 5/ Tester');
            $table->char('status', 1)->comment('1/ On Working 2/ Retired');
            $table->char('type_of_work', 1)->comment('1/ Fulltime 2/ Partime 3/ Probationary Staff 4/ Intern');
            $table->integer('ins_id');
            $table->integer('upd_id')->nullable();
            $table->dateTime('ins_datetime');
            $table->dateTime('upd_datetime')->nullable();
            $table->char('del_flag', 1)->default(0);
            $table->foreign('team_id')->references('id')->on('m_teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_employees');
    }
};
