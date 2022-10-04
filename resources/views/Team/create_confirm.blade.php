@extends('layouts.master')
@section('content')
    <div class="flow_url">
        <p>Team - Create Confirm</p>
    </div>
    <form class="form_container" action="{{route('Team.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">Name*</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="name" value="{{$name}}">
            </div>
        </div>
        <div class="row submit_box">
            <a onclick="history.back()" class="btn search_box__btn__items">Back</a>
            <input type="submit" value="Save" name="submit" onclick="return confirm('Are you sure?')" class="btn search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection

