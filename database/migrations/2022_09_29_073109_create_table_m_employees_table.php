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
            $table->integer('team_id')->nullable();
            $table->string('email',128);
            $table->string('first_name',128);
            $table->string('last_name',128);
            $table->char('gender', 1)->comment('Employee/GenderEnum');
            $table->date('birthday');
            $table->string('address',256);
            $table->string('avatar',128);
            $table->integer('salary')->unsigned();
            $table->char('position', 1)->comment('Employee/PositionEnum');
            $table->char('status', 1)->comment('Employee/StatusEnum');
            $table->char('type_of_work', 1)->comment('Employee/TypeOfWorkEnum');
            $table->integer('ins_id');
            $table->integer('upd_id')->nullable();
            $table->dateTime('ins_datetime');
            $table->dateTime('upd_datetime')->nullable();
            $table->char('del_flag', 1)->default(0);
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
