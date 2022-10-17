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
        <p><a href="{{route('Employee.search')}}">Search </a><i class="arrow right"></i> Employee Edit</p>
    </div>
    <form class="form_container" action="{{route('Employee.edit_confirm', $employee->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form_box">
            <div class="row form_input">
                <div class="col-md-2">ID</div>
                <p class="col-md-4 search_box__form--input">{{$employee->id}}</p>
            </div>
            <div class="row form_input">
                <label class="col-md-2" for="inputGroupFile" aria-describedby="inputGroupFileAddon">Avatar*</label>
                <input type="file" class="col-md-4 file_upload" name="avatarFile" id="inputGroupFile">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <img src="{{ !empty(old('avatar')) ? config('constants.url_avatar').old('avatar') : $employee->getAvatar}}" class="avatar_profile" id="preview">
                <input type="hidden" name="old_avatar" value="{{ old('avatar') ?? $employee->avatar}}">
            </div>
            <div class="row form_input">
                <div class="col-md-2">Team*</div>
                <select name="team_id" class="search_box__form search_box__form--select">
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" {{ old('team_id') == $team->id || $employee->team_id == $team->id ? "selected" : "" }}>
                            {{ $team->name }}
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
                <input class="col-md-4 search_box__form--input" type="text" name="first_name" value="{{ old('first_name') ?? $employee->first_name }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Last Name*</div>
                <input type="text" name="last_name" maxlength="128" class="col-md-4 search_box__form--input" value="{{ old('last_name') ?? $employee->last_name }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Email*</div>
                <input type="text" name="email" maxlength="128" class="col-md-4 search_box__form--input" value="{{ old('email') ?? $employee->email }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Gender*</div>
                <input type="hidden" name="gender" value="">
                @foreach($gender as $option => $value)
                    <input type="radio" name="gender" value="{{ $value }}" class="col-md-1 form_input" @checked(old('gender') == $value || $employee->gender == $value)>
                    <label class="col-md-2 form_input">{{ $option }}</label>
                @endforeach
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Birthday*</div>
                <input type="date" name="birthday" class="col-md-4 search_box__form--input" value="{{ old('birthday') ?? $employee->birthday }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Address*</div>
                <input type="text" name="address" class="col-md-4 search_box__form--input" value="{{ old('address') ?? $employee->address }}">
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
            <div class="row form_input">
                <div class="col-md-2">Salary*</div>
                <input type="number" name="salary" class="col-md-4 search_box__form--input" value="{{ old('salary') ?? $employee->salary }}">
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
                    @foreach($position as $option => $value)
                        <option value="{{ $value }}" @selected(old('position') == $value || $employee->position == $value) >
                            {{ $option }}
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
                <div class="col-md-2">Type of work*</div>
                <select name="type_of_work" class="search_box__form search_box__form--select">
                    @foreach($typeOfWork as $option => $value)
                        <option value="{{ $value }}" @selected(old('type_of_work') == $value || $employee->type_of_work == $value) >
                            {{ $option }}
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
                <div class="col-md-2">Status*</div>
                <input type="hidden" name="status" value="">
                @foreach($status as $option => $value)
                    <input type="radio" name="status" value="{{ $value }}" class="col-md-1 form_input" @checked(old('status') == $value || $employee->status == $value)>
                    <label class="col-md-2 form_input">{{ $option }}</label>
                @endforeach
            </div>
            <div class="row form_input">
                <div class="col-md-2"></div>
                <p id="validate--username" class="validate"
                   style="color:red; font-size:12px"></p>
            </div>
        </div>
        <div class="row submit_box">
            <a href="{{ route('Employee.edit', $employee) }}" class="btn reset-btn search_box__btn__items">Reset</a>
            <input type="submit" value="Confirm" name="save" class="search_box__btn__items search_box__btn__items--blue">
        </div>
    </form>
@endsection

