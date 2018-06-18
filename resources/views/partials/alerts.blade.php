@if (Session::has('alert-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('alert-success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div><!--alert-success-->
@endif

@if (Session::has('alert-warning'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        {{ Session::get('alert-warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div><!--alert-warning-->
@endif

@if (Session::has('alert-error'))
    <div class="alert alert-error alert-dismissible fade show" role="alert">
        {{ Session::get('alert-error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div><!--alert-error-->
@endif