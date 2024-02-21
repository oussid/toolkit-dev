@extends('layouts.auth')

@section('content')
    <form action="{{route('reset-password-email')}}" method="POST" class="auth-form">
        @csrf
        <div class="auth-form-top">
            <h2 class="form-heading">Forgot your Password?</h2>
            <p class="text">Enter your email address. <br> We'll send you a link to reset your password.</p>
        </div>
        
        <div class="auth-form-main">
            <div>
                <div class="form-error">
                    @error('email')
                    <p class="form-error">{{$message}}</p> 
                    @enderror
                </div>
                <input type="email" placeholder="Email address" name="email" >
            </div>
            
            <button type="submit">SEND</button>
        </div>

        <div class="auth-form-bottom">
            <a href="{{route('login')}}" class="form-link"> Return to Login Page</a>
        </div>
    </form>
@endsection