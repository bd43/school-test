@extends('layouts.app')

@section('content')
    <h1>Students ({{ $students->total() }}) <a href="{{ route('students.create')}}" class="badge badge-success">Add new student</a></h1>

    @include('students.filters')

    @foreach($students->chunk(3) as $studentsChunk)
     <div class="row students">
        @foreach($studentsChunk as $student)
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card student">
                <img class="card-img-top" src="http://i.pravatar.cc/350" alt="{{ $student->full_name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $student->full_name }}</h5>
                    <p class="card-text">
                        Current year: {{ $student->year }}
                    </p>
                    <p class="card-text">
                        Enrolled in: 
                        <ul>
                        @foreach($student->classes as $class)
                        <li>{{ $class->name }}</li>
                        @endforeach
                        </ul>
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('students.show', ['id' => $student->id]) }}" class="btn btn-info btn-block btn-resource">View student profile</a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('students.edit', ['id' => $student->id]) }}" class="btn btn-warning btn-block btn-resource">Edit student profile</a>
                        </div>
                        <div class="col-12">
                            {!! Form::open(['url' => route('students.destroy', ['id' => $student->id]), 'method' => 'DELETE', 'id' => 'deleteResource-' . $student->id]) !!}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs btn-block"/>Delete student profile</button>
                            {!! Form::close() !!}
                        </div>
                    </div><!--row-->
                </div><!--card-body-->
            </div><!--card-->
        </div>
        @endforeach
    </div><!--row-->
    @endforeach

    <hr/>
    
    {{ $students->links() }}
@endsection