@extends('layouts.app')

@section('content')
    <h1>Edit class ({{ '#'.$class->id }})</h1>

    <div class="row">
        <div class="col-12">
            {!! Form::open(['url' => route('classes.update', ['id' => $class->id]), 'method' => 'PATCH', 'id' => 'edit-class']) !!}
                {!! Form::hidden('resource_id', $class->id ) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Class name: ') !!}
                    {!! Form::text('name', $class->name, ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                </div><!--form-group-->
    
                <div class="form-group">
                    {!! Form::label('teacher_id', 'Teacher: ') !!}
                    <select class="form-control custom-select" name="teacher_id" id="teacher_id">
                        <option value="">-- pick a teacher --</option>
                        @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @if($class->teachers->first()->id == $teacher->id) selected @endif>{{ $teacher->full_name }}</option>
                        @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->first('teacher_id') }}</span>
                </div><!--form-group-->
    
                <div class="form-group">
                    {!! Form::label('year', 'Year: ') !!}
                    {!! Form::number('year', $class->year, ['class' => 'form-control',  'v-model' => 'year']) !!}
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                </div><!--form-group-->
                    
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">Save</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('classes.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                        </div>
                    </div><!--row-->
                </div><!--form-group-->
            {!! Form::close() !!}
        </div><!--col-->
    </div><!--row-->
    
@endsection

@section('scripts')
<script>app.__vue__.year = {{ $class->year }};</script>
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\StudentClass\UpdateClassRequest', '#edit-class'); !!}
@endsection