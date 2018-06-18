<div id="accordion">
        <div class="card">
            <div class="card-header" id="filter">
                <h5 class="mb-0">Filter results</h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    {!! Form::open(['url' => route('students.index'), 'method' => 'GET', 'id' => 'filter']) !!}
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('first_name', 'Firstname') !!} 
                                {!! Form::text('first_name', old('first_name'), ['class' => 'form-control']) !!}
                            </div>
                            <!--form-group-->
                        </div>
                        <!--col-->
    
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('last_name', 'Lastname') !!} 
                                {!! Form::text('last_name', old('last_name'), ['class' => 'form-control']) !!}
                            </div>
                            <!--form-group-->
                        </div>
                        <!--col-->
    
                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('class_id', 'Class') !!}
                                <select name="class_id" id="class_id" class="form-control custom-select">
                                    <option value="">-- pick a class --</option>
                                    @foreach($classes as $cls)
                                    <option value="{{ $cls->id }}" @if(old('class_id') == $cls->id) selected @endif>{{ $cls->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--form-group-->
                        </div>
                        <!--col-->

                        <div class="col-12 col-md-6 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('year', 'Year') !!}
                                <select name="year" id="year" class="form-control custom-select">
                                    <option value="">-- pick year --</option>
                                    @foreach(range(1,3) as $year)
                                    <option value="{{ $year }}" @if(old('year') == $year) selected @endif>{{ "Year #" . $year }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!--form-group-->
                        </div>
                        <!--col-->
                    </div>
                    <!--row-->
    
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <button type="submit" class="btn btn-success btn-block">Search</button>
                        </div>
                        <div class="col-12 col-sm-6">
                            <a href="{{ route('students.index') }}" class="btn btn-secondary btn-block">Remove filters</a>
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