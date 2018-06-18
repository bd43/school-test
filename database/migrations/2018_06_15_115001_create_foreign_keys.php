<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		// Schema::table('classes', function(Blueprint $table) {
		// 	$table->foreign('teacher_id')->references('id')->on('teachers')
		// 				->onDelete('cascade')
		// 				->onUpdate('cascade');
		// });
		Schema::table('grades', function(Blueprint $table) {
			$table->foreign('class_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('grades', function(Blueprint $table) {
			$table->foreign('teacher_id')->references('id')->on('teachers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('grades', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_student', function(Blueprint $table) {
			$table->foreign('class_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_student', function(Blueprint $table) {
			$table->foreign('student_id')->references('id')->on('students')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_teacher', function(Blueprint $table) {
			$table->foreign('class_id')->references('id')->on('classes')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('class_teacher', function(Blueprint $table) {
			$table->foreign('teacher_id')->references('id')->on('teachers')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		// Schema::table('classes', function(Blueprint $table) {
		// 	$table->dropForeign('classes_teacher_id_foreign');
		// });
		Schema::table('grades', function(Blueprint $table) {
			$table->dropForeign('grades_class_id_foreign');
		});
		Schema::table('grades', function(Blueprint $table) {
			$table->dropForeign('grades_teacher_id_foreign');
		});
		Schema::table('grades', function(Blueprint $table) {
			$table->dropForeign('grades_student_id_foreign');
		});
		Schema::table('class_student', function(Blueprint $table) {
			$table->dropForeign('class_student_class_id_foreign');
		});
		Schema::table('class_student', function(Blueprint $table) {
			$table->dropForeign('class_student_student_id_foreign');
		});
		Schema::table('class_teacher', function(Blueprint $table) {
			$table->dropForeign('class_teacher_class_id_foreign');
		});
		Schema::table('class_teacher', function(Blueprint $table) {
			$table->dropForeign('class_teacher_teacher_id_foreign');
		});
	}
}