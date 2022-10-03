@extends('layouts.master')
@section('content')
<div class="flow_url">
    <p>Admin Create</p>
</div>
<form class="form_container" action="" method="POST" enctype="multipart/form-data">
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
            <img src="{{url('public')}}/img/avatar_default.png" class="avatar_profile"  id="preview">
            <input type="hidden" name="old_avatar" value="">
        </div>
        <div class="row form_input">
            <div class="col-md-2">Name*</div>
            <input type="text" name="name" maxlength="128" class="col-md-4 search_box__form--input" value="" >
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
            <div class="col-md-2">Password*</div>
            <input type="text" maxlength="100" name="password" class="col-md-4 search_box__form--input pw" value="">
        </div>
        <div class="row form_input">
            <div class="col-md-2"></div>
            <p id="validate--username" class="validate"
               style="color:red; font-size:12px"></p>
        </div>
        <div class="row form_input">
            <div class="col-md-2">Password Verify*</div>
            <input type="text"  maxlength="100" name="password_verify" class="col-md-4 search_box__form--input pw" value="<?php echo $data['password_verify'] ?? "" ?>">
        </div>
        <div class="row form_input">
            <div class="col-md-2"></div>
            <p id="validate--username" class="validate"
               style="color:red; font-size:12px"></p>
        </div>
        <div class="row form_input">
            <div class="col-md-2">Role*</div>
            <input type="hidden" name="role_type" value="">
            <input type="radio" name="role_type" value="1" class="col-md-1 form_input" >
            <label class="col-md-2 form_input">Super Admin</label>
            <input type="radio" name="role_type" value="2" class="col-md-1 form_input" >
            <label class="col-md-2 form_input">Admin</label>
        </div>
        <div class="row form_input">
            <div class="col-md-2"></div>
            <p id="validate--username" class="validate"
               style="color:red; font-size:12px"></p>
        </div>
    </div>
    <div class="row submit_box">
        <input type="submit" value="Reset" name="submit" class="search_box__btn__items">
        <input type="submit" value="Save" name="save" class="search_box__btn__items search_box__btn__items--blue">
    </div>
</form>
@endsection
