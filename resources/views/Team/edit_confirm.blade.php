@extends('layouts.master')
@section('title')
    Team - Edit Confirm
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p>Team - Create</p>
    </div>
    <form class="form_container" action="{{route('Team.update', $team->id)}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">ID</div>
                <p class="col-md-4 search_box__form--input">{{$team->id}}</p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Name*</div>
                <input type="text" name="name" maxlength="128" class="col-md-4 search_box__form--input input--confirm"
                       value="{{$team_upd->name}}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
        </div>
        <div class="row submit_box">
            <a onclick="history.back()" class="btn search_box__btn__items">Back</a>
            <input type="submit" value="Save" name="save" onclick="return confirm('Are you sure?')"
                   class="btn search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection
