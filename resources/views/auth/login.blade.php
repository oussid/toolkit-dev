@extends('layouts.auth')

@section('content')
    <form action="{{route('authenticate')}}" method="POST" class="auth-form">
        @csrf
        <div class="auth-form-top">
            <h2 class="form-heading">SIGN IN</h2>
        </div>
        
        <div class="auth-form-main">
            <div>
                <div class="form-error">
                    @error('email')
                    <p class="error-message">{{$message}}</p> 
                    @enderror
                </div>
                <input type="email" placeholder="Email address" name="email" value="">
            </div>
            
            <div>
                <div class="form-error">
                    @error('password')
                    <p class="error-message">{{$message}}</p> 
                    @enderror
                </div>
                <input type="password" placeholder="Password" name="password" value=""> 
            </div>
            <button type="submit">Login</button>
        </div>

        <div class="auth-form-bottom">
            <a href="{{route('forgot-password-form')}}" class="form-link"> <i class="fa-solid fa-lock"></i>  Forgot password?</a>
        </div>
    </form>
@endsection