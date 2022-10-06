<?php
$prefix = Route::current()->getPrefix();
$name = Route::current()->getName()
?>
<div class="header_navbar">
    <ul class="row header_navbar__list">
        <li class="header_navbar__list__items">
            <ul class="header_navbar__list__items--menu {{ $prefix == '/Team' ? 'active' : '' }}">
                <li class="header_navbar__list__items__menu--hover">
                    <a href="{{route('Team.search')}}">Team management</a>
                    <i class="arrow menu-down"></i>
                </li>
                <li class="header_navbar__list__items__menu header_navbar__list__items__menu--first {{ $name == 'Team.search' ? 'active' : '' }}">
                    <a href="{{route('Team.search')}}">Search</a>
                </li>
                <li class="header_navbar__list__items__menu header_navbar__list__items__menu--last {{ $name == 'Team.create' ? 'active' : '' }}">
                    <a href="{{route('Team.create')}}">Create</a>
                </li>
            </ul>
        </li>
        <li class="header_navbar__list__items">
            <ul class="header_navbar__list__items--menu {{ $prefix == '/Employee' ? 'active' : '' }}">
                <li class="header_navbar__list__items__menu--hover">
                    <a href="{{route('Employee.search')}}">Employee management</a>
                    <i class="arrow menu-down"></i>
                </li>
                <li class="header_navbar__list__items__menu header_navbar__list__items__menu--first {{ $name == 'Employee.search' ? 'active' : '' }}">
                    <a href="{{route('Employee.search')}}">Search</a>
                </li>
                <li class="header_navbar__list__items__menu header_navbar__list__items__menu--last {{ $name == 'Employee.create' ? 'active' : '' }}">
                    <a href="{{route('Employee.create')}}">Create</a>
                </li>
            </ul>
        </li>
        <li class="header_navbar__list__items">
            <p class="header_navbar__list__items__menu--logout"><a href="{{route('logout')}}">Logout</a>
            <P>
        </li>
    </ul>
</div>
