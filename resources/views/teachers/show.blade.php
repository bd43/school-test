@extends('layouts.app')

@section('content')
    <h1>Teacher profile page ({{ '#'.$teacher->id }})</h1>

    <div class="row">
        <div class="col-12 col-sm-6 col-md-4">
            <img src="http://i.pravatar.cc/350" class="img-fluid" alt="{{ $teacher->full_name }}" />
        </div><!--col-->
        <div class="col-12 col-sm-6 col-md-8">
            <h5><strong>Firstname:</strong> {{ $teacher->first_name }}</h5>
            <h5><strong>Lastname:</strong> {{ $teacher->last_name }}</h5>
            <h5><strong>Number of classes: {{ $teacher->classes->count() }}</strong></h5>
            <ul>
                @foreach($teacher->classes as $class)
                <li><h6>{{ $class->name }}</h6></li>
                @endforeach
            </ul>
        </div><!--col-->
    </div><!--row-->

    <hr/>

    <div class="row">
        <div class="col-12">
            <h5>Detailed view </h5>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Class</th>
                        <th scope="col">Enrolled students</th>
                        <th scope="col">Year</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($teacher->classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->students->count() }}</td>
                        <td>{{ $class->year }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--col-->
    </div><!--row-->
@endsection