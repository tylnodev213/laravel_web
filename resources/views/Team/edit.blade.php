@extends('layouts.master')
@section('title')
    Team - Edit
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p><a href="{{route('Team.search')}}">Search </a><i class="arrow right"></i> Team Edit</p>
    </div>
    <form class="form_container" action="{{route('Team.edit_confirm', $team->id)}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">ID</div>
                <p class="col-md-4 search_box__form--input">{{$team->id}}</p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Name*</div>
                <input type="text" name="name" maxlength="128" class="col-md-4 search_box__form--input"
                       value="{{$team->name}}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
        </div>
        <div class="row submit_box">
            <a href="{{ route('Team.edit', $team) }}" class="btn reset-btn search_box__btn__items">Reset</a>
            <input type="submit" value="Confirm" name="save"
                   class="search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection
