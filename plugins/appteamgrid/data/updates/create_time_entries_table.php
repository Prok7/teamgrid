<?php namespace AppTeamgrid\Data\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTimeEntriesTable extends Migration
{
    public function up()
    {
        Schema::create('teamgrid_time_entries', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer("task_id")->index();
            $table->dateTime("start_time");
            $table->dateTime("end_time")->nullable();
            $table->integer("tracked_seconds")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teamgrid_time_entries');
    }
}
