@extends('layouts.master')
@section('title')
    Employee - Edit
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p>Team - Edit</p>
    </div>
    <form class="form_container" action="{{route('Employee.update', $employee->id)}}" method="POST"
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
                <img src="{{url('storage')}}/app/{{ $employee_upd->getAvatar }}" class="avatar_profile" id="preview">
                <input type="hidden" name="avatar" value="{{ $employee_upd->getAvatar }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Team</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="team_id"
                       value="{{ $employee_upd->team_id }}">
                <div class="col-md-4 search_box__form--input">{{ $teams[$employee_upd->team_id] }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">First Name</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="first_name"
                       value="{{ $employee_upd->first_name }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Last Name</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="last_name"
                       value="{{ $employee_upd->last_name }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Email</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="email"
                       value="{{ $employee_upd->email }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Gender</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="gender"
                       value="{{ $employee_upd->gender }}">
                <div class="col-md-4 search_box__form--input">{{ $employee_upd->getGender }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Birthday</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="birthday"
                       value="{{ $employee_upd->birthday }}">
                <div class="col-md-4 search_box__form--input">{{ $employee_upd->birthDate }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Address</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="text" name="address"
                       value="{{ $employee_upd->address }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Salary</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="salary"
                       value="{{ $employee_upd->salary }}">
                <div class="col-md-4 search_box__form--input">{{ $employee_upd->getSalary }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Position</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="position"
                       value="{{ $employee_upd->position }}">
                <div class="col-md-4 search_box__form--input">{{ $employee_upd->getPosition }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Type of work</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="type_of_work"
                       value="{{ $employee_upd->type_of_work }}">
                <div class="col-md-4 search_box__form--input">{{ $employee_upd->getTypeOfWork }}</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Status</div>
                <input class="col-md-4 search_box__form--input input--confirm" type="hidden" name="status"
                       value="{{ $employee_upd->status }}">
                <div class="col-md-4 search_box__form--input">{{ $employee_upd->getStatus }}</div>
            </div>
        </div>
        <div class="row submit_box">
            <input type="submit" value="Back" name="submit"
                   class="btn search_box__btn__items">
            <input type="submit" value="Save" name="submit" onclick="return confirm('Are you sure?')"
                   class="btn search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection

