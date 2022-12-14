@extends('layouts.master')
@section('title')
    Employee - Edit Confirm
@endsection
@section('stylesheet')
    {{ asset('css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p><a href="{{route('Employee.search')}}">Search </a><i class="arrow right"></i> Employee - Edit Confirm</p>
    </div>
    <form class="form_container" action="{{route('Employee.update', $employee->id)}}" method="POST" id="myForm"
          enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">ID</div>
                <p class="col-md-4 search_box__form--input">{{$employee->id}}</p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Avatar</div>
                <img src="{{ $employee->getAvatar }}" class="avatar_profile" id="preview">
                <input type="hidden" name="old_avatar" value="{{ $employee->avatar }}">
                <input type="hidden" name="avatar" value="{{ $employee->avatar }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Team</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="team_id"
                       value="{{ $employee->team_id }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->team->name }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">First Name</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="first_name"
                       value="{{ $employee->first_name }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Last Name</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="last_name"
                       value="{{ $employee->last_name }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Email</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="email"
                       value="{{ $employee->email }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Gender</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="gender"
                       value="{{ $employee->gender }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->getGender }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Birthday</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="birthday"
                       value="{{ date('Y-m-d', strtotime($employee->birthday)) }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->birthDate }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Address</div>
                <input class="col-md-8 search_box__form--input input--confirm" type="text" name="address"
                       value="{{ $employee->address }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Salary</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="salary"
                       value="{{ $employee->salary }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->getSalary }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Position</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="position"
                       value="{{ $employee->position }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->getPosition }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Type of work</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="type_of_work"
                       value="{{ $employee->type_of_work }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->getTypeOfWork }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Status</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="status"
                       value="{{ $employee->status }}">
                <div class="col-md-4 search_box__form--input">{{ $employee->getStatus }}</div>
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

