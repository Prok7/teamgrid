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
            $table->integer("project_id");
            $table->string("text");
            $table->timestamp("planned_start")->nullable();
            $table->timestamp("planned_end")->nullable();
            $table->string("planned_time")->nullable();
            $table->timestamp("deadline")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jozef_teamgrid_tasks');
    }
}
