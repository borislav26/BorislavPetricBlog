@extends('auth._layout.layout')
@section('content')
<div class="card-header text-center">
    
    <span class="splash-description">Please enter your user information.</span>
</div>
<div class="card-body">
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <p>Don't worry, we'll send you an email to reset your password.</p>
        <div class="form-group">

            <input 
                id="email" 
                type="email" 

                class="form-control form-control-lg @error('email') is-invalid @enderror" 
                name="email" value="{{ old('email') }}" 
                required autocomplete="email" 
                autofocus
                >
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group pt-1">
            <button type="submit" class="btn btn-block btn-primary btn-xl">
                {{ __('Reset Password') }}
            </button>
            
        </div>
    </form>
</div>
<!--<div class="card-footer text-center">
    <span>Don't have an account? <a href="#">Sign Up</a></span>
</div>-->
@endsection
