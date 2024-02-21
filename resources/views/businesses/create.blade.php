@extends('layouts.main')

@section('content')
<x-breadcrum :data="$breadcrum"/>

    <div class="form-container">
        {{-- BUSINESS INFO FIELDS --}}
        <form action="{{route('businesses.store')}}" method="POST" class="form-section">
            @csrf
            <div class="section-row">
                <h2 class="subtitle">Add Business Info</h2>
            </div>
            
            <div class="section-row">
                <div class="section-col">
                    @error('address')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="address" type="text" placeholder="Business Address" value="{{old('address')}}">
                </div>
            </div>

            <div class="section-row">
                <div class="section-col">
                    @error('name')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="name" type="text" placeholder="Business Name"  value="{{old('name')}}">
                </div>
            </div>

            <div class="section-row two-col">
                <div class="section-col">
                    @error('number')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="number" type="text" placeholder="Business Number"  value="{{old('number')}}">
                </div>
                <div class="section-col">
                    @error('niche')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="niche" type="text" placeholder="Business Niche"  value="{{old('niche')}}">
                </div>
            </div>


            <div class="section-row">
                <h2 class="subtitle">Additional Details</h2>
            </div>
            
            <div class="section-row two-col">
                <div class="section-col">
                    @error('website')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="website" type="text" placeholder="Business Website"  value="{{old('website')}}">
                </div>
                <div class="section-col">
                    @error('rating')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="rating" type="text" placeholder="Business Rating"  value="{{old('rating')}}">
                </div>
            </div>
            
            <div class="section-row">
                <div class="section-col">
                    @error('email')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="email" type="text" placeholder="Business Email"  value="{{old('email')}}">
                </div>
            </div>

            <div class="section-row">
                <div class="section-col">
                    @error('notes')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <textarea class="field" name="notes"  rows="5" placeholder="Notes about the business">{{old('notes')}}</textarea>
                </div>
            </div>

            <div class="section-row">
                <div class="section-col reverse">
                    <button onclick="addBusiness()">ADD</button>
                </div>
            </div>
        </form>
    </div>
@endsection
