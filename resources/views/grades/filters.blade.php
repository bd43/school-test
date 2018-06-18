<div id="accordion">
        <div class="card">
            <div class="card-header" id="filter">
                <h5 class="mb-0">Filter results</h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    {!! Form::open(['url' => route('grades.index'), 'method' => 'GET', 'id' => 'filter']) !!}
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                {!! Form::label('student_id', 'Student') !!}
                                <select name="student_id" id="student_id" class="form-control custom-select">
                                    <option value="">-- pick a student --</option>
                                    @foreach($students as $student)
                                    <option value="{{ $student->id }}" @if(old('student_id') == $student->id) selected @endif>{{ $student->full_name }}</option>
                                    @endforeach
                                </select>
                            </div><!--form-group-->
                        </div><!--col-->

                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                {!! Form::label('teacher_id', 'Teacher') !!}
                                <select name="teacher_id" id="teacher_id" class="form-control custom-select">
                                    <option value="">-- pick a teacher --</option>
                                    @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" @if(old('teacher_id') == $teacher->id) selected @endif>{{ $teacher->full_name }}</option>
                                    @endforeach
                                </select>
                            </div><!--form-group-->
                        </div><!--col-->
    
                        <div class="col-12 col-md-4 col-lg-4">
                            <div class="form-group">
                                {!! Form::label('class_id', 'Class') !!}
                                <select name="class_id" id="class_id" class="form-control custom-select">
                                    <option value="">-- pick a class --</option>
                                    @foreach($classes as $cls)
                                    <option value="{{ $cls->id }}" @if(old('class_id') == $cls->id) selected @endif>{{ $cls->name }}</option>
                                    @endforeach
                                </select>
                            </div><!--form-group-->
                        </div><!--col-->
                        
                    </div>
                    <!--row-->
    
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">Search</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('grades.index') }}" class="btn btn-secondary btn-block">Remove filters</a>
                        </div>
                    </div>
                    <!--row-->
    
    
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!--card-->
    </div>
    <!--accordion-->
    <hr/>