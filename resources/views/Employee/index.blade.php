@extends('layouts.master')
@section('title')
    Employee - Search
@endsection
@section('stylesheet')
    {{ asset('css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="notice">
        @if(session()->has('message_successful'))
            <div class="alert alert-success">
                {{ session()->get('message_successful') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @elseif($errors->has('id'))
            <div class="alert alert-danger">{{ $errors->first('id') }}</div>
        @endif
    </div>
    <div class="search_box">
        <form action="" id="myForm">
            <div class="row">
                <p class="search_box__form">Team</p>
                <select name="team_id" class="search_box__form search_box__form--select">
                    <option value="">-Choose-</option>
                    @foreach($teams as $team)
                        <option value="{{ $team->id }}" @selected( request()->get('team_id') == $team->id) >
                            {{ $team->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="row">
                <p class="search_box__form">Name</p>
                <input type="text" class="search_box__form search_box__form--input" name="name" value="{{ request()->get('name') }}">
            </div>
            <div class="row">
                <p class="search_box__form">Email</p>
                <input type="text" class="search_box__form search_box__form--input" name="email" value="{{ request()->get('email') }}">
            </div>
            <div class="row search_box__btn">
                <a href="{{ route('Employee.search') }}" class="btn reset-btn search_box__btn__items">Reset</a>
                <input type="submit" value="Search" class="search_box__btn__items search_box__btn__items--blue">
            </div>
        </form>
    </div>
    <div class="row btn_export">
        <a href="{{ route('Employee.export_file',request()->all()) }}" class="btn btn-primary">Export CSV</a>
    </div>
    <div class="data">
        <div class="paginate">
            {{ $employees->links() }}
        </div>
        <table width="100%" border="1" cellspacing="0" class="table table-striped">
            <tr class="table-primary">
                <th class="text-center col-md-1">
                    <a href="">
                        <span>ID</span>
                        @if ($employees->count()>0)
                            <a href="{{ sortByField('id').getRequest(request()->except(['sort','sortDirection'])) }}">
                                <span class="sort">
                                    <i class="arrow up"></i>
                                    <i class="arrow down"></i>
                                </span>
                            </a>
                        @endif
                    </a>
                </th>
                <th class="col-md-2"></th>
                <th class="text-center col-md-2">
                    <a href="">
                        <span>Team</span>
                        @if ($employees->count()>0)
                            <a href="{{ sortByField('team_id').getRequest(request()->except(['sort','sortDirection'])) }}">
                            <span class="sort">
                                <i class="arrow up"></i>
                                <i class="arrow down"></i>
                            </span>
                            </a>
                        @endif
                    </a>
                </th>
                <th class="text-center col-md-2">
                    <a href="">
                        <span>Name</span>
                        @if ($employees->count()>0)
                            <a href="{{ sortByField('last_name').getRequest(request()->except(['sort','sortDirection'])) }}">
                            <span class="sort">
                                <i class="arrow up"></i>
                                <i class="arrow down"></i>
                            </span>
                            </a>
                        @endif
                    </a>
                </th>
                <th class="text-center col-md-2">
                    <a href="">
                        <span>Email</span>
                        @if ($employees->count()>0)
                            <a href="{{ sortByField('email').getRequest(request()->except(['sort','sortDirection'])) }}">
                            <span class="sort">
                                <i class="arrow up"></i>
                                <i class="arrow down"></i>
                            </span>
                            </a>
                        @endif
                    </a>
                </th>
                <th class="text-center col-md-2">Action</th>
            </tr>
            @if ($employees->count()>0)
                @foreach($employees as $employee)
                    <tr>
                        <td class="column text-center">{{$employee->id}}</td>
                        <td class="column text-center"><img src="{{$employee->getAvatar}}" class="avatar_img" alt="avatar admin"></td>
                        <td class="column ">{{$employee->team->name ?? config('constants.ROOM_IS_NULL')}}</td>
                        <td class="column ">{{$employee->fullName}}</td>
                        <td class="column ">{{$employee->email}}</td>
                        <td class="column text-center">
                            <a href="{{route('Employee.edit', $employee)}}" class="btn btn-edit">Edit</a>
                            <a href="#" data-id="{{ $employee->id }}" class="btn btn-del delete" data-toggle="modal" data-target="#deleteModal">Delete</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="column text-center" colspan="6">{{config('constants.NO_RESULTS_TABLE')}}</td>
                </tr>
            @endif
        </table>
    </div>
@endsection
@extends("modal.modalDelete")
@section('formDelete')
    <form action="{{ route('Employee.destroy', 'id') }}" method="post" id="myForm">
        @csrf
        @method('DELETE')
        <input id="id_delete" type="hidden" name="id" >
        <div class="modal-footer row" style="justify-content: space-between;">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button id="submit" class="btn btn-success success">OK</button>
        </div>
    </form>
@endsection
