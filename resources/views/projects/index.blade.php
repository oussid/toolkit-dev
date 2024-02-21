@extends('layouts.main')

@section('content')
<x-breadcrum :data="$breadcrum" />

{{-- filter --}}
<div class="filter-head">
    <div class="filter-head-section">
        <div class="filter-box">
            <button class="not-button dropdownBtn" onclick="toggleDropdown('statusFilterDropdown')">Status <i class="fa-solid fa-chevron-down"></i></button>
            <form id="statusFilterDropdown" class="filter-dropdown dropdown visibleOnHoverOut">
                <div class="filter-dropdown-item">
                    <p class="dark">Filter by project status</p>
                </div>
                <div class="filter-dropdown-section">
                    <div class="filter-dropdown-item indent">
                        <input {{(!request()->query('status') OR empty(request()->query('status'))) ? 'checked' : '' }} type="radio" name="status" value="" id="all"> <label for="all">All</label>
                    </div>
                

                <div class="filter-dropdown-item indent">
                    <input {{(request()->query('status') AND request()->query('status') == 'pending') ? 'checked' : '' }} type="radio" name="status" value="pending" id="pending"> <label for="pending">Pending</label>
                </div>
                <div class="filter-dropdown-item indent">
                    <input {{(request()->query('status') AND request()->query('status') == 'ongoing') ? 'checked' : '' }}  type="radio" name="status" value="ongoing" id="ongoing"> <label for="ongoing">Ongoing</label>
                </div>
                <div class="filter-dropdown-item indent">
                    <input {{(request()->query('status') AND request()->query('status') == 'completed') ? 'checked' : '' }}  type="radio" name="status" value="completed" id="completed"> <label for="completed">Completed</label>
                </div>
                <div class="filter-dropdown-item indent">
                    <input {{(request()->query('status') AND request()->query('status') == 'canceled') ? 'checked' : '' }}  type="radio" name="status" value="canceled" id="canceled"> <label for="canceled">Canceled</label>
                </div>
            </div>
                <div class="filter-dropdown-item"><button>Filter</button> </div>
            </form>
        </div>
    </div>

    <div class="filter-head-section">

    </div>

    <form class="filter-head-section">
        <input type="text" placeholder="Search" name="search" value="{{ request()->query('search') ? request()->query('search') : '' }}">
        <button><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>
</div>
{{-- table --}}
<x-table :props="$tableProps" />
@endsection
