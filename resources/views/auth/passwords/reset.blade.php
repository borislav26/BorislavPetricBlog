@extends('auth._layout.layout')
@section('content')
<div class="card-header">
    <h3 class="mb-1">@lang('Reset your password')</h3>
    <p>@lang('Please enter your new password.')</p>
</div>
<form class="card-body" method="POST" action="{{ route('password.update') }}">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="form-group">

        <input 
            id="email" 
            type="email" 
            class="form-control @error('email') is-invalid @enderror form-control-lg" 
            name="email" value="{{ $email ?? old('email') }}" 
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
            class="form-control @error('password') is-invalid @enderror form-control-lg" 
            name="password" 

            required autocomplete="new-password"
            >
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
       
        <input 
            id="password-confirm" 
            type="password" 
            class="form-control form-control-lg" 
            name="password_confirmation" 
            required autocomplete="new-password"
            >
    </div>

        <button class="btn btn-block btn-primary" type="submit">@lang('Reset Password')</button>
    

</form>

@endsection

