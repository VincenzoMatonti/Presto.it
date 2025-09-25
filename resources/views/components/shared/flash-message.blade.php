<div class="d-flex justify-content-center align-items-center">
    @if (session()->has('errorMessage'))
    <div class="alert alert-danger text-center shadow rounded w-50 border-3">
        {{ session('errorMessage') }}
    </div>
    @endif
    @if (session()->has('message'))
    <div class="alert alert-success text-center shadow rounded w-50 border-3">
        {{ session('message') }}
    </div>
    @endif
    @if (session()->has('successMessage'))
    <div class="alert alert-success text-center shadow rounded w-50 border-3">
        {{ session('successMessage') }}
    </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success text-center shadow rounded w-50 border-3">
        {{ session('success') }}
    </div>
    @endif
</div>