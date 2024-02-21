@extends('layouts.main')

@section('content')

<x-breadcrum :data="$breadcrum"/>

@if ($businesses->count() > 0 || request()->has('search') || request()->has('niche') || request()->has('user_id') || request()->has('is_contacted') || request()->has('contacted_by'))
<div class="filter-head">
    <div class="filter-head-section">
        <div class="filter-box">
            <button class="not-button dropdownBtn" onclick="toggleDropdown('statusFilterDropdown')">Filter <i class="fa-solid fa-chevron-down"></i></button>
            <form action="{{route('businesses.index')}}" id="statusFilterDropdown" class="filter-dropdown dropdown visibleOnHoverOut">
                <div class="filter-dropdown-section">
                    <div class="filter-dropdown-item">
                        <p class="dark">Business Niche</p>
                    </div>
                    <div class="filter-dropdown-item ">
                        <select name="niche" >
                            <option value="">All</option>
                            @foreach ($niches as $niche)
                                <option {{ ( request()->query('niche') && request()->query('niche')==$niche ) ? 'selected' : '' }} value="{{$niche}}">{{$niche}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="filter-dropdown-section">
                    <div class="filter-dropdown-item">
                        <p class="dark">Added by</p>
                    </div>
                    <div class="filter-dropdown-item ">
                        <select name="user_id" >
                            <option value="">All</option>
                            @foreach ($users as $user)
                                <option {{ ( request()->query('user_id') && request()->query('user_id')==$user->id ) ? 'selected' : '' }} value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="filter-dropdown-section">
                    <div class="filter-dropdown-item">
                        <p class="dark">Contact status</p>
                    </div>
                    <div class="filter-dropdown-item ">
                        <select name="status" id="isContacted">
                            <option value="">All</option>
                            <option {{ ( request()->query('status') && request()->query('status')===0 ) ? 'selected' : '' }} value="0">Not Contacted</option>
                            <option {{ ( request()->query('status') && request()->query('status')==1 ) ? 'selected' : '' }} value="1">Contacted</option>
                            <option {{ ( request()->query('status') && request()->query('status')==2 ) ? 'selected' : '' }} value="2">Recontact Later</option>
                            <option {{ ( request()->query('status') && request()->query('status')==4 ) ? 'selected' : '' }} value="4">No Answer</option>
                            <option {{ ( request()->query('status') && request()->query('status')==3 ) ? 'selected' : '' }} value="3">Unavailable</option>
                        </select>
                    </div>
                </div>
                    
                <div class="filter-dropdown-section hidden" id="contactedBy">
                    <div class="filter-dropdown-item">
                        <p class="dark">Contacted by</p>
                    </div>
                    <div class="filter-dropdown-item ">
                        <select name="contacted_by" id="contactedByField">
                            <option value="">All</option>
                            @foreach ($users as $user)
                                <option {{ ( request()->query('contacted_by') && request()->query('contacted_by')==$user->id ) ? 'selected' : '' }} value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="filter-dropdown-item"><button>Filter</button> </div>
                {{-- TO KEEP OTHER QUERY PARAMS AFTER SEARCH --}}
                @foreach(request()->query() as $name => $value)
                    @if($name == 'search')
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endif
                @endforeach
            </form>
        </div>
    </div>

    <div class="filter-head-section">

    </div>

    <form action="{{route('businesses.index')}}" method="GET" class="filter-head-section">
        <input type="text" placeholder="Search" name="search" value="{{ request()->query('search') ? request()->query('search') : '' }}">
        <button><i class="fa-solid fa-magnifying-glass"></i></button>
        {{-- TO KEEP OTHER QUERY PARAMS AFTER SEARCH --}}
        @foreach(request()->query() as $name => $value)
            @if($name !== 'search')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endif
        @endforeach
    </form>
</div>
@endif

    <div class="cards-container">
        @foreach ($businesses as $business)
            @livewire('business-card', ['business' => $business], key($user->id))
        @endforeach
    </div>
    
    {{$businesses->links('pagination-links')}}

    @if ($businesses->count() == 0) 
        <div class="empty-container">
            <h1>OOPS! NO BUSINESSES FOUND.</h1>
        </div>
    @endif
@endsection

{{-- CARDS SCRIPT --}}
<script src="{{asset('js/card.js')}}" defer></script>
{{-- FILTER SCRIPT --}}
<script src="{{asset('js/businessFilter.js')}}" defer></script>