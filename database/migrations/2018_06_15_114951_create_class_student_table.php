<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassStudentTable extends Migration {

	public function up()
	{
		Schema::create('class_student', function(Blueprint $table) {
			$table->integer('class_id')->unsigned();
			$table->integer('student_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('class_student');
	}
}