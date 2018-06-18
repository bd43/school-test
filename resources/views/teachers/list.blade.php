@extends('layouts.app')

@section('content')
    <h1>Teachers ({{ $teachers->total() }}) <a href="{{ route('teachers.create')}}" class="badge badge-success">Add new teacher</a></h1>

    @include('teachers.filters')
    
    @foreach($teachers->chunk(3) as $teachersChunk)
     <div class="row students">
        @foreach($teachersChunk as $teacher)
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card student">
                <img class="card-img-top" src="http://i.pravatar.cc/350" alt="{{ $teacher->full_name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $teacher->full_name }}</h5>
                    <p class="card-text">
                        Teaches the following classes: 
                        <ul>
                        @forelse($teacher->classes as $class)
                        <li>{{ $class->name }}</li>
                        @empty
                        No classes at the moment
                        @endforelse
                        </ul>
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('teachers.show', ['id' => $teacher->id]) }}" class="btn btn-info btn-block btn-resource">View teacher profile</a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('teachers.edit', ['id' => $teacher->id]) }}" class="btn btn-warning btn-block btn-resource">Edit teacher profile</a>
                        </div>
                        <div class="col-12">
                            {!! Form::open(['url' => route('teachers.destroy', ['id' => $teacher->id]), 'method' => 'DELETE', 'id' => 'deleteResource-' . $teacher->id]) !!}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs btn-block"/>Delete teacher profile</button>
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
    
    {{ $teachers->links() }}
@endsection