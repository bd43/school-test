<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClassTeacherTable extends Migration {

	public function up()
	{
		Schema::create('class_teacher', function(Blueprint $table) {
			$table->integer('class_id')->unsigned();
			$table->integer('teacher_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('class_teacher');
	}
}