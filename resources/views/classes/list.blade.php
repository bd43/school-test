@extends('layouts.app')

@section('content')
    <h1>Classes ({{ $classes->total() }}) <a href="{{ route('classes.create')}}" class="badge badge-success">Add new class</a></h1>

    @include('classes.filters')

    @foreach($classes->chunk(3) as $classesChunk)
     <div class="row classes">
        @foreach($classesChunk as $class)
        <div class="col-12 col-sm-12 col-md-4">
            <div class="card class">
                <div class="card-body">
                    <h5 class="card-title">{{ $class->name }}</h5>
                    <p class="card-text">
                        Year: {{ $class->year }}
                    </p>
                    <p class="card-text">
                        Number of enrolled students: {{ $class->students->count() }}
                    </p>

                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('classes.show', ['id' => $class->id]) }}" class="btn btn-info btn-block btn-resource">View class</a>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('classes.edit', ['id' => $class->id]) }}" class="btn btn-warning btn-block btn-resource">Edit class</a>
                        </div>
                        <div class="col-12">
                            {!! Form::open(['url' => route('classes.destroy', ['id' => $class->id]), 'method' => 'DELETE', 'id' => 'deleteResource-' . $class->id]) !!}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-xs btn-block"/>Delete class</button>
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

    {{ $classes->links() }}
@endsection