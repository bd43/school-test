@extends('layouts.app')

@section('content')
    <h1>Class ({{ '#'.$class->id }})</h1>

    <div class="row">
       
        <div class="col-12">
            <h5><strong>Name:</strong> {{ $class->name }}</h5>
            <h5><strong>Taught by:</strong> {{ $class->teachers->first()->full_name }}</h5>
            <h5><strong>Current year:</strong> {{ $class->year }}</h5>
            <h5><strong>Number of students enrolled:</strong> {{ $class->students->count() }}</h5>
            <h5><strong>Class average:</strong> {{ $class->average }}</h5>
        </div><!--col-->
    </div><!--row-->

    <hr/>

    <div class="row">
        <div class="col-12">
            <h5>Detailed view of class: </h5>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Student</th>
                        <th scope="col">Grades</th>
                        <th scope="col">Final grade</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($class->students as $student)
                    <tr>
                        <td>{{ $student->full_name }}</td>
                        <td>
                            @foreach($class->grades->intersect($student->grades) as $grade)
                            <em>{{ $grade->value }}</em>
                            @endforeach
                        </td>
                        <td><strong>{{ round($class->grades->intersect($student->grades)->avg('value'), 2) }}</strong></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--col-->
    </div><!--row-->
@endsection