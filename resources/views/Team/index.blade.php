@extends('layouts.master')
@section('title')
    Team - Search
@endsection
@section('stylesheet')
    {{ asset('public/css/style.css') }}
@endsection
@section('content')
    @include("layouts.navbar")
    <div class="notice">
    </div>
    <div class="search_box">
        <form action="" method="GET" id="myForm">
            <div class="row">
                <p class="search_box__form">Email</p>
                <input type="text" class="search_box__form search_box__form--input" name="email" value="">
            </div>
            <div class="row">
                <p class="search_box__form">Name</p>
                <input type="text" class="search_box__form search_box__form--input" name="name" value="">
            </div>
            <div class="row search_box__btn">
                <input type="submit" name="submit" value="Reset" class="reset-btn search_box__btn__items">
                <input type="submit" value="Search" class="search_box__btn__items search_box__btn__items--blue">
            </div>
        </form>
    </div>
    <div class="data">
        <div class="paginate">
        </div>
        <table width="100%" border="1" cellspacing="0" class="table table-striped">
            <tr class="table-primary">
                <th class="text-center col-md-1">
                    <a href="">
                        <span>ID</span>
                        <span class="sort">
                        <i class="arrow up"></i>
                        <i class="arrow down"></i>
                    </span>
                    </a>
                </th>
                <th class="text-center col-md-7">
                    <a href="">
                        <span>Name</span>
                        <span class="sort">
                        <i class="arrow up"></i>
                        <i class="arrow down"></i>
                    </span>
                    </a>
                </th>
                <th class="text-center col-md-2">Action</th>
            </tr>
            @if (isset($teams))
                @foreach($teams as $team)
                    <tr>
                        <td class="column text-center col-md-1">{{$team->id}}</td>
                        <td class="column col-md-7">{{$team->name}}</td>
                        <td class="column text-center col-md-2">
                            <a href="{{route('Team.update', $team)}}" class="btn btn-edit">Edit</a>
                            <form action="{{route('Team.destroy', $team)}}" method="POST" style="display:inline">
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
                    <td class="text-center" colspan="3">{{config('constants.NO_RESULTS_TABLE')}}</td>
                </tr>
            @endif
        </table>
    </div>
@endsection
