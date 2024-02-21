@extends('layouts.main')

@section('content')
<x-breadcrum :data="$breadcrum" />

    <div class="form-container">
        {{-- BUSINESS INFO FIELDS --}}
        <form class="form-section" action="{{route('projects.store')}}" method="POST">
            @csrf
            <div class="section-row">
                <h2 class="subtitle">Add Project Info</h2>
            </div>
            {{-- DATES --}}
            <div class="section-row two-col">
                <div class="section-col">
                    <label class="light-gray" for="start_date">Start Date</label>
                    @error('start_date')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" id="start_date" type="date" name="start_date" value="{{old('start_date')}}">
                </div>
                <div class="section-col">
                    <label class="light-gray" for="finish_date">Finish Date</label>
                    @error('finish_date')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" id="finish_date" type="date" name="finish_date" value="{{old('finish_date')}}">
                </div>
            </div>
            
            
            {{-- BUSINESS AND STATUS --}}
            <div class="section-row two-col">
                <div class="section-col">
                    @error('business_id')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <select name="business_id">
                        <option value="">Business</option>
                        @foreach ($businesses as $business)
                            <option {{old('business_id') == $business->id ? 'selected' : ''}} value="{{$business->id}}">{{$business->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="section-col">
                    @error('status')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <select name="status">
                        <option value="">Status</option>
                        <option {{old('status') == 'pending' ? 'selected' : ''}} value="pending">Pending</option>
                        <option {{old('status') == 'ongoing' ? 'selected' : ''}} value="ongoing">Ongoing</option>
                        <option {{old('status') == 'completed' ? 'selected' : ''}} value="completed">Completed</option>
                        <option {{old('status') == 'canceled' ? 'selected' : ''}} value="canceled">Canceled</option>
                    </select>
                </div>
            </div>
            
            {{-- OBJECTIVES --}}
            <div class="section-row">
                <div class="section-col">
                    <p class="form-error" id="nameErrorField"></p>
                    <div class="section-row row">
                        <input   class="field" id="objectiveField" type="text" placeholder="Project Objectives">
                        <button onclick="addObjective()">ADD</button>
                    </div>
                </div>
            </div>
            {{-- OBJECTIVES AREA --}}
            <div class="section-row">
                <input type="text" name="objectives" id="hiddenObjectives" hidden value="{{old('objectives')}}">
                @error('objectives')
                    <p class="form-error">{{$message}}</p>
                @enderror
                <div class="dashed-area center" id="objectivesArea">
                    <p class="dashed-area-message">Objectives will be added here.</p>
                </div>
            </div>

            {{-- OBJECTIVES --}}
            <div class="section-row">
                <div class="section-col">
                    @error('notes')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <textarea name="notes" id="notes" cols="30" rows="10" placeholder="Additional Details (optional)">{{old('total_paid')}}</textarea>
                </div>
            </div>

            {{-- NOTES --}}
            <div class="section-row">
                <div class="section-col reverse">
                    <button>CREATE PROJECT</button>
                </div>
            </div>
        </form>

       
        </div>
    </div>
@endsection

{{-- BULK-CREATE SCRIPT --}}
<script src="{{asset('js/projectObjectives.js')}}" defer></script>