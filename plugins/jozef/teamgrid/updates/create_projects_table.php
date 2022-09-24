<?php namespace Jozef\Teamgrid\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('jozef_teamgrid_projects', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->index();
            $table->string("title");
            $table->boolean("completed")->default("false");
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jozef_teamgrid_projects');
    }
}
