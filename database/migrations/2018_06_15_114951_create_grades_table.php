<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGradesTable extends Migration {

	public function up()
	{
		Schema::create('grades', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('class_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
			$table->integer('student_id')->unsigned();
			$table->float('value', 4, 2);
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('grades');
	}
}