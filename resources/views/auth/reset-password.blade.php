@extends('layouts.auth')

@section('content')
    <form action="{{route('reset-password')}}" method="POST" class="auth-form">
        @csrf
        <div class="auth-form-top">
            <h2 class="form-heading">PASSWORD RESET</h2>
            <p class="text">Enter your new password.</p>
        </div>
        
        <input type="text"  value="{{$token}}" hidden name="token">
        <div class="auth-form-main">
            <div>
                <div class="form-error">
                    @error('password')
                    <p class="form-error">{{$message}}</p> 
                    @enderror
                </div>
                <input type="password" placeholder="New password" name="password" >
            </div>
            <div>
                <div class="form-error">
                    @error('password_confirmation')
                    <p class="form-error">{{$message}}</p> 
                    @enderror
                </div>
                <input type="password" placeholder="Confirm new password" name="password_confirmation" >
            </div>
            
            <button type="submit">CHANGE</button>
        </div>
    </form>
@endsection