@extends('layouts.app')

@section('content')
    <h1>Create teacher profile page</h1>

    <div class="row">
        <div class="col-12">
            {!! Form::open(['url' => route('teachers.store'), 'method' => 'POST', 'id' => 'add-teacher']) !!}
                <div class="form-group">
                    {!! Form::label('first_name', 'Firstname:') !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('first_name') }}</span>
                </div><!--form-group-->

                <div class="form-group">
                    {!! Form::label('last_name', 'Lastname:') !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('last_name') }}</span>
                </div><!--form-group-->

                
                <div class="form-group {{ $errors->has('classes') }}">
                    @foreach($classes as $year => $group)
                    <div class="year-group">
                        <label for="classes"><strong>{{ 'Classes for year ' . $year }}</strong></label>
                            @foreach($group->chunk(2) as $chunk)
                            <div class="row">
                                @foreach($chunk as $cls)
                                <div class="col-12 col-sm-6">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="classes[]" value="{{ $cls->id }}" id="{{ 'class-' . $cls->id }}">
                                    <label class="form-check-label" for="{{ 'class-' . $cls->id }}">
                                        {{ $cls->name }}
                                    </label>
                                    </div>
                                </div>
                                @endforeach
                            </div><!--row-->
                            @endforeach
                        </div><!--year-group-->
                    @endforeach
                    <span class="text-danger">{{ $errors->first('classes') }}</span>
                </div><!--form-group-->

                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">Save</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('teachers.index') }}" class="btn btn-secondary btn-block">Cancel</a>
                        </div>
                    </div><!--row-->
                </div><!--form-group-->
            {!! Form::close() !!}
        </div><!--col-->
    </div><!--row-->
    
@endsection

@section('scripts')
<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Teacher\CreateTeacherRequest', '#add-teacher'); !!}
@endsection