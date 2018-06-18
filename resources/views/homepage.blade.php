@extends('layouts.app')

@section('content')
    @include('partials.jumbotron')
    <div class="row cards">
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Students</h5>
                    <p class="card-text">Display a listing of all enrolled students</p>
                    <a href="{{ route('students.index') }}" class="btn btn-primary">Visit students</a>
                </div>
            </div><!--card-->
        </div><!--col-->
        
        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Teachers</h5>
                    <p class="card-text">Display a listing of all available teachers</p>
                    <a href="{{ route('teachers.index') }}" class="btn btn-primary">Visit teachers</a>
                </div>
            </div><!--card-->
        </div><!--col-->

        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Classes</h5>
                    <p class="card-text">Display a listing of available classes</p>
                    <a href="{{ route('classes.index') }}" class="btn btn-primary">Visit classes</a>
                </div>
            </div><!--card-->
        </div><!--col-->

        <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Grades</h5>
                    <p class="card-text">Display a tabled view of all grades</p>
                    <a href="{{ route('grades.index') }}" class="btn btn-primary">Visit grades</a>
                </div>
            </div><!--card-->
        </div><!--col-->
    </div><!--row-->
@endsection