@extends('layouts.master');
@section('title')
    Login
@endsection
@section('stylesheet')
    {{ asset('css/login.css') }}
@endsection
@section('content')
<div class="wrapper">
    <div id="formContent">
        <form action="{{route('process_login')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form_container">
                <label for="email">Email</label>
            </div>
            <input type="text" id="email" name="email" value="{{ old('email') }}">
            <div class="form_container">
                @if ($errors->has('email'))
                    <p class="help is-danger text-danger">{{ $errors->first('email') }}</p>
                @endif
            </div>
            <div class="form_container">
                <label for="password">Password</label>
            </div>
            <input type="password" id="password" name="password" value="{{ old('password') }}">
            <div class="form_container">
                @if ($errors->has('password'))
                    <p class="help is-danger text-danger">{{ $errors->first('password') }}</p>
                @endif
            </div>
            <div class="form-group"></div>
            <div class="row form-group">
                <input type="submit" name="submit" value="Log In">
            </div>
        </form>
    </div>
</div>
@endsection
