@extends('layouts.app')

@section('content')
    <h1>Grades ({{ $grades->total() }}) <a href="{{ route('grades.create')}}" class="badge badge-success">Add new grade</a></h1>

    @include('grades.filters')

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Student</th>
                <th scope="col">Class</th>
                <th scope="col">Value</th>
                <th scope="col">Teacher</th>
                <th scope="col">Year</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->id }}</td>
                <td>{{ $grade->student->full_name }}</td>
                <td>{{ $grade->class->name }}</td>
                <td>{{ $grade->value }}</td>
                <td>{{ $grade->teacher->full_name }}</td>
                <td>{{ $grade->class->year }}</td>
                <td>
                    <div class="col-12">
                        <a href="{{ route('grades.edit', ['id' => $grade->id]) }}" class="btn btn-warning btn-block btn-resource">Edit grade</a>
                    </div>
                    <div class="col-12">
                        {!! Form::open(['url' => route('grades.destroy', ['id' => $grade->id]), 'method' => 'DELETE', 'id' => 'deleteResource-' . $grade->id]) !!}
                            {{ method_field('DELETE') }}
                            <button type="submit" class="btn btn-danger btn-xs btn-block"/>Delete grade</button>
                        {!! Form::close() !!}
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <hr/>

    {{ $grades->links() }}
@endsection