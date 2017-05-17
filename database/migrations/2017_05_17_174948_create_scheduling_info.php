<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulingInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheduling_info', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->date('event_date');
			$table->string('event_name');
			$table->time('start_time');
			$table->time('end_time');
			$table->timestamps();
        });
		
		Schema::create('scheduling_users', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('scheduling_id');
			$table->integer('user_id');
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
        Schema::dropIfExists('scheduling_info');
		Schema::dropIfExists('scheduling_users');
    }
}
