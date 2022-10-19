@extends('layouts.master')
@section('title')
    Team - Edit Confirm
@endsection
@section('stylesheet')
    {{ asset('css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p><a href="{{route('Team.search')}}">Search </a><i class="arrow right"></i> Team - Edit Confirm</p>
    </div>
    <form class="form_container" action="{{route('Team.update', $team_upd->id)}}" method="POST"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">ID</div>
                <p class="col-md-4 search_box__form--input">{{$team_upd->id}}</p>
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
            <input type="submit" value="Back" name="submit" class="btn search_box__btn__items">
            <input type="button" name="submit" value="Save" id="submitBtn" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"/>
            <!-- Modal -->
            @include("modal.modalConfirm")
        </div>
    </form>
@endsection
