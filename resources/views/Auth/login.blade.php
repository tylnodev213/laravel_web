@extends('layouts.master');
@section('title')
    Login
@endsection
@section('stylesheet')
    {{ asset('public/css/login.css') }}
@endsection
@section('content')
<div class="wrapper">
    <div id="formContent">
        <form action="{{route('process_login')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="email">Email</label>
            </div>
            <input type="text" id="email" name="email" value="">
            <div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div>
                <label for="password">Password</label>
            </div>
            <input type="password" id="password" name="password" value="">
            <div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row">
                <input type="submit" name="submit" value="Log In">
            </div>
        </form>
    </div>
</div>
@endsection
