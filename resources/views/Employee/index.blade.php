@extends('layouts.master')
@section('title')
    Employee - Search
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="notice">
        {{ getNoticeAction() }}
    </div>
    <div class="search_box">
        <form action="" id="myForm">
            <div class="row">
                <p class="search_box__form">Team</p>
                <select name="team_id" class="search_box__form search_box__form--select">
                    @foreach($teams as $id => $team)
                        <option value="{{ $id }}" @selected( request()->get('team_id') == $id) >
                            {{ $team }}
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
                <input type="submit" name="submit" value="Reset" class="reset-btn search_box__btn__items">
                <input type="submit" value="Search" class="search_box__btn__items search_box__btn__items--blue">
            </div>
        </form>
    </div>
    <div class="row btn_export">
        <a href="{{ route('Employee.export_file') }}" class="btn btn-primary">Export CSV</a>
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
                            <a href="{{ route('Employee.search', ['sort' => 'id', getRequest(request()->except('sort'))]) }}">
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
                            <a href="{{ route('Employee.search', ['sort' => 'team_id', getRequest(request()->except('sort'))]) }}">
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
                            <a href="{{ route('Employee.search', ['sort' => 'last_name', getRequest(request()->except('sort'))]) }}">
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
                            <a href="{{ route('Employee.search', ['sort' => 'email', getRequest(request()->except('sort'))]) }}">
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
                        <td class="column text-center"><img src="{{url('storage')."/app/".$employee->getAvatar}}" class="avatar_img" alt="avatar admin"></td>
                        <td class="column ">{{$employee->team->name ?? config('constants.ROOM_IS_NULL')}}</td>
                        <td class="column ">{{$employee->fullName}}</td>
                        <td class="column ">{{$employee->email}}</td>
                        <td class="column text-center">
                            <a href="{{route('Employee.edit', $employee)}}" class="btn btn-edit">Edit</a>
                            <form action="{{route('Employee.destroy', $employee)}}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')" class="btn btn-del" id="delete">Delete
                                </button>
                            </form>
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
