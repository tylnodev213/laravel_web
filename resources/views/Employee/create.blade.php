@extends('layouts.master')
@section('title')
    Employee - Create
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="flow_url">
        <p>Employee - Create</p>
    </div>
    <form class="form_container" action="{{route('Employee.create_confirm')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form_box">
            <div class="row form_input">
                <label class="col-md-2" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Avatar*</label>
                <input type="file" class="col-md-4 file_upload" name="avatar" id="inputGroupFile">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <img src="{{url('public')}}/img/avatar_default.png" class="avatar_profile" id="preview">
                <input type="hidden" name="old_avatar" value="">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Team*</div>
                <select name="team_id" class="search_box__form search_box__form--select">
                    <option value="">-Choose-</option>
                    @foreach($teams as $id => $team)
                        <option value="{{ $id }}">
                            {{ $team }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">First Name*</div>
                <input type="text" name="first_name" maxlength="128" class="col-md-4 search_box__form--input" value="">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Last Name*</div>
                <input type="text" name="last_name" maxlength="128" class="col-md-4 search_box__form--input" value="">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Email*</div>
                <input type="text" name="email" maxlength="128" class="col-md-4 search_box__form--input" value="">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Gender*</div>
                <input type="hidden" name="gender" value="">
                <input type="radio" name="gender" value="1" class="col-md-1 form_input">
                <label class="col-md-2 form_input">Male</label>
                <input type="radio" name="gender" value="2" class="col-md-1 form_input">
                <label class="col-md-2 form_input">Female</label>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Birthday*</div>
                <input type="date" name="birthday" class="col-md-4 search_box__form--input" value="">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Address*</div>
                <input type="text" name="address" class="col-md-4 search_box__form--input" value="">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Salary*</div>
                <input type="number" name="salary" class="col-md-4 search_box__form--input" value="">
                <div class="col-md-2"> VND</div>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Position*</div>
                <select name="position" class="search_box__form search_box__form--select">
                    <option value="">-Choose-</option>
                    <option value="1">Manager</option>
                    <option value="2">Team leader</option>
                    <option value="3">BSE</option>
                    <option value="4">Dev</option>
                    <option value="5">Tester</option>
                </select>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Type of work*</div>
                <select name="type_of_work" class="search_box__form search_box__form--select">
                    <option value="">-Choose-</option>
                    <option value="1">Fulltime</option>
                    <option value="2">Partime</option>
                    <option value="3">Probationary Staff</option>
                    <option value="4">Intern</option>
                </select>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Status*</div>
                <input type="hidden" name="status" value="">
                <input type="radio" name="status" value="1" class="col-md-1 form_input">
                <label class="col-md-2 form_input">On working</label>
                <input type="radio" name="status" value="2" class="col-md-1 form_input">
                <label class="col-md-2 form_input">Retired</label>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
        </div>
        <div class="row submit_box">
            <input type="submit" value="Reset" name="submit" class="search_box__btn__items">
            <input type="submit" value="Confirm" name="save" class="search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection
