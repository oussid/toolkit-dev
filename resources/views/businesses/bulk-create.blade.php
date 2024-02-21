@extends('layouts.main')

@section('content')
<x-breadcrum :data="$breadcrum"/>
    <div class="form-container">
        {{-- BUSINESS INFO FIELDS --}}
        <div class="form-section">
            <div class="section-row">
                <h2 class="subtitle">Add Business Info</h2>
            </div>
            
            <div class="section-row">
                <div class="section-col">
                    <p class="form-error" id="addressErrorField"></p>
                    <input class="field" id="address" type="text" placeholder="Business Address" >
                </div>
            </div>

            <div class="section-row two-col">
                <div class="section-col">
                    <p class="form-error" id="nameErrorField"></p>
                    <input class="field" id="name" type="text" placeholder="Business Name">
                </div>
                <div class="section-col">
                    <p class="form-error" id="numberErrorField"></p>
                    <input class="field" id="number" type="text" placeholder="Business Number" >
                </div>
            </div>
            
            <div class="section-row two-col">
                <div class="section-col">
                    <p class="form-error" id="websiteErrorField"></p>
                    <input class="field" id="website" type="text" placeholder="Business Website" >
                </div>
                <div class="section-col">
                    <p class="form-error" id="nicheErrorField"></p>
                    <input class="field" id="niche" type="text" placeholder="Business Niche" >
                </div>
            </div>

            <div class="section-row">
                <div class="section-col">
                    <p class="form-error" id="notesErrorField"></p>
                    <textarea class="field" id="notes"  rows="5" placeholder="Additional Info"></textarea>
                </div>
            </div>
            
            <div class="section-row">
                <div class="section-col reverse">
                    <button onclick="addBusiness()">ADD</button>
                </div>
            </div>
        </div>

        {{-- BULK CREATE TEXTAREA --}}
        <div class="form-section">
                <div class="section-row">
                    <h2 class="subtitle">Bulk-Create Businesses</h2>
                </div>
                <form action="{{route('businesses.bulk-store')}}" method="POST">
                    @csrf
                <div class="section-row">
                    <div class="section-col">
                        @error('businesses')
                            <p class="form-error">{{$message}}</p>
                        @enderror
                        <textarea readonly name="businesses" id="bulkArea"  rows="5" placeholder="address|,|name|,|number|,|niche|,|website|#|...">{{old('businesses')}}</textarea>
                    </div>
                </div>
                
                <div class="section-row">
                    <div class="section-col reverse">
                        <button>Create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- BULK-CREATE SCRIPT --}}
<script src="{{asset('js/bulkCreate.js')}}" defer></script>