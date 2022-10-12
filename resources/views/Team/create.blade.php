@extends('layouts.master')
@section('title')
    Team - Create
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p>Team - Create</p>
    </div>
    <form class="form_container" action="{{route('Team.create_confirm')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">Name*</div>
                <input type="text" name="name" maxlength="128" class="col-md-4 search_box__form--input">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
        </div>
        <div class="row submit_box">
            <a href="{{ route('Team.create') }}" class="btn reset-btn search_box__btn__items">Reset</a>
            <input type="submit" value="Confirm" name="save"
                   class="search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection
