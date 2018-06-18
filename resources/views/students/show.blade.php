@extends('layouts.app')

@section('content')
    <h1>Student profile page ({{ '#'.$student->id }})</h1>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <img src="http://i.pravatar.cc/350" class="img-fluid" alt="{{ $student->full_name }}" />
        </div><!--col-->
        <div class="col-12 col-sm-6 col-md-8">
            <h5><strong>Firstname:</strong> {{ $student->first_name }}</h5>
            <h5><strong>Lastname:</strong> {{ $student->last_name }}</h5>
            <h5><strong>Current year:</strong> {{ $student->year }}</h5>
            <h5><strong>Classes enrolled in: {{ $student->classes->count() }}</strong></h5>
            <ul>
                @foreach($student->classes as $class)
                <li><h6>{{ $class->name }}</h6></li>
                @endforeach
            </ul>
        </div><!--col-->
    </div><!--row-->

    <hr/>

    <div class="row">
        <div class="col-12">
            <h5>Detailed view of classes: </h5>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Class</th>
                        <th scope="col">Grades</th>
                        <th scope="col">Final grade</th>
                        <th scope="col">Year</th>
                        <th scope="col">Teacher</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($student->classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>{{ $class->name }}</td>
                        <td>
                            @foreach($class->grades->intersect($student->grades) as $grade)
                            {{ $grade->value }}
                            @endforeach
                        </td>
                        <td>{{ round($class->grades->intersect($student->grades)->avg('value'), 2) }}</td>
                        <td>{{ $student->year }}</td>
                        <td>{{ $class->teachers->first()->full_name or '-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--col-->
    </div><!--row-->
@endsection