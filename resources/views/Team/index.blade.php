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
        <form action="" id="myForm">
            <div class="row">
                <p class="search_box__form">Name</p>
                <input type="text" class="search_box__form search_box__form--input" name="name" value="{{ request()->get('name') ?? '' }}">
            </div>
            <div class="row search_box__btn">
                <input type="submit" name="submit" value="Reset" class="reset-btn search_box__btn__items">
                <input type="submit" value="Search" class="search_box__btn__items search_box__btn__items--blue">
            </div>
        </form>
    </div>
    <div class="data">
        <div class="paginate">
            {{ $teams->links() }}
        </div>
        <table width="100%" border="1" cellspacing="0" class="table table-striped">
            <tr class="table-primary">
                <th class="text-center col-md-1">
                    <a href="">
                        <span>ID</span>
                        @if ($teams->count()>0)
                            <a href="{{ route('Team.search', ['sort' => 'id', getRequest(request()->except('sort'))]) }}">
                            <span class="sort">
                                <i class="arrow up"></i>
                                <i class="arrow down"></i>
                            </span>
                            </a>
                        @endif
                    </a>
                </th>
                <th class="text-center col-md-7">
                    <a href="">
                        <span>Name</span>
                        @if ($teams->count()>0)
                            <a href="{{ route('Team.search', ['sort' => 'name', getRequest(request()->except('sort'))]) }}">
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
            @if ($teams->count()>0)
                @foreach($teams as $team)
                    <tr>
                        <td class="column text-center col-md-1">{{$team->id}}</td>
                        <td class="column col-md-7">{{$team->name}}</td>
                        <td class="column text-center col-md-2">
                            <a href="{{route('Team.edit', $team)}}" class="btn btn-edit">Edit</a>
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
