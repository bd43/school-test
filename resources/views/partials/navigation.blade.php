<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item @if(checkCurrentUrlForSlug('students')) active @endif">
                <a class="nav-link" href="{{ route('students.index') }}">Students <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(checkCurrentUrlForSlug('classes')) active @endif">
                <a class="nav-link" href="{{ route('classes.index') }}">Classes <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(checkCurrentUrlForSlug('teachers')) active @endif">
                <a class="nav-link" href="{{ route('teachers.index') }}">Teachers <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item @if(checkCurrentUrlForSlug('grades')) active @endif">
                <a class="nav-link" href="{{ route('grades.index') }}">Grades <span class="sr-only">(current)</span></a>
            </li>
        </ul>
    </div>
</nav>