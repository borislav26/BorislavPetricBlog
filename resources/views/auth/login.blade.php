@extends('auth._layout.layout')
@section('content')
<div class="card-header text-center">

    <span class="splash-description">@lang('Please enter your user information.')</span></div>
<div class="card-body">
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">


            <input id="username" 
                   type="email" 
                   class="form-control form-control-lg @error('email') is-invalid @enderror " 
                   name="email" 
                   value="{{ old('email') }}" 
                   required autocomplete="email" 
                   autofocus
                   >
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">

            <input 
                id="password" 
                type="password" 
                class="form-control form-control-lg @error('password') 
                is-invalid @enderror" 
                name="password" 
                required 
                autocomplete="current-password"
                >

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label class="custom-control custom-checkbox">

                <input 
                    class="custom-control-input" 
                    type="checkbox" 
                    name="remember" 
                    id="remember" 
                    {{ old('remember') ? 'checked' : '' }}
                    >
                    <span class="custom-control-label">@lang('Remember Me')</span>
            </label>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">@lang('Sign in')</button>
    </form>
</div>
<div class="card-footer bg-white p-0  ">
    <div class="card-footer-item card-footer-item-bordered">
        <a href="#" class="footer-link">Create An Account</a></div>
    

        @if (Route::has('password.request'))
        <a class="footer-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    
</div>
@endsection
