<?php namespace Jozef\Teamgrid\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateTasksTable extends Migration
{
    public function up()
    {
        Schema::create('jozef_teamgrid_tasks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer("project_id")->index();
            $table->integer("user_id")->index();
            $table->string("title");
            $table->dateTime("planned_start")->nullable();
            $table->dateTime("planned_end")->nullable();
            $table->integer("planned_time")->nullable();
            $table->dateTime("deadline")->nullable();
            $table->boolean("tracking")->default(false);
            $table->boolean("completed")->default("false");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jozef_teamgrid_tasks');
    }
}
