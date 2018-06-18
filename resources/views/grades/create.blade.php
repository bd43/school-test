@extends('layouts.app')

@section('content')
    <h1>Add a new grade</h1>

    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
    <div class="row">
        <div class="col-12">
            {!! Form::open(['url' => route('grades.store'), 'method' => 'POST', 'id' => 'add-grade']) !!}
                <div class="form-group {{ $errors->has('student_id') }}">
                    {!! Form::label('student_id', 'Student: ') !!}
                    <select class="form-control" name="student_id" id="student_id" v-model="selectedStudentID">
                        <option value="">-- pick a student --</option>
                        <option :value="student.id" v-for="student in allStudents">@{{ student.full_name }}</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('student_id') }}</span>
                </div><!--form-group-->

                <div class="form-group {{ $errors->has('class_id') }}" v-if="selectedStudent">
                    {!! Form::label('class_id', 'Pick class: ') !!}
                    <select class="form-control" name="class_id" id="class_id" v-model="selectedClassID">
                        <option value="">-- pick a student --</option>
                        <option :value="cls.id" v-for="cls in selectedStudent.classes">@{{ cls.name }}</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('class_id') }}</span>
                </div><!--form-group-->

                <div class="form-group {{ $errors->has('teacher_id') }}" v-if="selectedClassID">
                    {!! Form::label('teacher_id', 'Teacher: ') !!}
                    <select class="form-control" name="teacher_id" id="teacher_id" v-model="selectedTeacherID">
                        <option :value="teacher.id" v-for="teacher in selectedClass.teachers">@{{ teacher.full_name }}</option>
                    </select>
                    <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                </div><!--form-group-->

                <div class="form-group {{ $errors->has('value') }}">
                    {!! Form::label('value', 'Grade value: ') !!}
                    {!! Form::number('value', old('value'), ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('value') }}</span>
                </div><!--form-group-->
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">Save</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('grades.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                        </div>
                    </div><!--row-->
                </div><!--form-group-->
            {!! Form::close() !!}
        </div><!--col-->
    </div><!--row-->
    
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Grade\CreateGradeRequest', '#add-grade'); !!}
@endsection