@extends('layouts.master')
@section('content')
<div class="flow_url">
    <p>Team - Create</p>
</div>
<form class="form_container" action="{{route('Team.update', $team->id)}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method("PUT")
    <div class="form_box">
        <div class="row form_input">
            <div class="col-md-2">ID</div>
            <p class="col-md-4 search_box__form--input">{{$team->id}}</p>
        </div>
        <div class="row form_input">
            <div class="col-md-2">Name*</div>
            <input type="text" name="name" maxlength="128" class="col-md-4 search_box__form--input input--confirm" value="{{$name}}">
        </div>
        <div class="row form_input">
            <div class="col-md-2"></div>
            <p id="validate--username" class="validate"
               style="color:red; font-size:12px"></p>
        </div>
    </div>
    <div class="row submit_box">
        <input type="submit" value="Reset" name="reset" class="search_box__btn__items">
        <input type="submit" value="Save" name="save" class="search_box__btn__items search_box__btn__items--blue">
    </div>
</form>
@endsection
