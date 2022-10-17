@extends('layouts.master')
@section('title')
    Team - Create Confirm
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p>Team - Create Confirm</p>
    </div>
    <form class="form_container" action="{{route('Team.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">Name*</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="name"
                       value="{{$team->name}}">
            </div>
        </div>
        <div class="row submit_box">
            <input type="submit" value="Back" name="submit" class="btn search_box__btn__items">
            <input type="button" name="submit" value="Save" id="submitBtn" data-toggle="modal"
                   data-target="#exampleModal" class="btn btn-primary"/>
            <!-- Modal -->
            @include("modal.modalConfirm")
        </div>
    </form>
@endsection

