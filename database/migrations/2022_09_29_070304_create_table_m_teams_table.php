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
        Schema::create('m_teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128);
            $table->string('ins_id',11);
            $table->string('upd_id',11)->nullable();
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
        Schema::dropIfExists('m_teams');
    }
};
