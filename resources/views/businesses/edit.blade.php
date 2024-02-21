@extends('layouts.main')

@section('content')
<x-breadcrum :data="$breadcrum" />
    <div class="form-container">
        {{-- BUSINESS INFO FIELDS --}}
        <form action="{{route('businesses.update', ['business' => $business->id])}}" method="POST" class="form-section">
            @csrf
            @method('PUT')
            <div class="section-row">
                <h2 class="subtitle">Edit Business Info</h2>
            </div>
            
            <div class="section-row">
                <div class="section-col">
                    <label class="">Business Address</label>
                    @error('address')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="address" type="text" placeholder="Business Address" value="{{$business->address}}">
                </div>
            </div>

            <div class="section-row two-col">
                <div class="section-col">
                    <label class="">Business Name</label>
                    @error('name')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="name" type="text" placeholder="Business Name" value="{{$business->name}}">
                </div>
                <div class="section-col">
                    <label class="">Business Number</label>
                    @error('number')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="number" type="text" placeholder="Business Number" value="{{$business->number}}">
                </div>
            </div>

            <div class="section-row two-col">
                <div class="section-col">
                    <label class="">Business Niche</label>
                    @error('niche')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="niche" type="text" placeholder="Business Niche" value="{{$business->niche}}">
                </div>
                <div class="section-col">
                    <label class="">Status</label>
                    @error('status')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <select name="status" id="">
                        <option value="0" {{$business->status== 0 ? 'selected' : '' }}>Not contacted</option>
                        <option value="1" {{$business->status== 1 ? 'selected' : '' }}>Contacted</option>
                        <option value="2" {{$business->status== 2 ? 'selected' : '' }}>Recontact later</option>
                        <option value="3" {{$business->status== 3 ? 'selected' : '' }}>Unavailable</option>
                    </select>
                </div>
            </div>


            <div class="section-row">
                <h2 class="subtitle">Additional Details</h2>
            </div>
            
            <div class="section-row two-col">
                <div class="section-col">
                    <label class="">Business Website</label>
                    @error('website')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="website" type="text" placeholder="Business Website" value="{{$business->website}}">
                </div>
                <div class="section-col">
                    <label class="">Business Rating</label>
                    @error('rating')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="rating" type="text" placeholder="Business Rating" value="{{$business->rating}}">
                </div>
            </div>
            
            <div class="section-row">
                <div class="section-col">
                    <label class="">Business Email</label>
                    @error('email')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <input class="field" name="email" type="text" placeholder="Business Email" value="{{$business->email}}">
                </div>
            </div>

            <div class="section-row">
                <div class="section-col">
                    <label class="">Notes</label>
                    @error('notes')
                        <p class="form-error">{{$message}}</p>
                    @enderror
                    <textarea class="field" name="notes"  rows="5" placeholder="Notes about the business">{{$business->notes}}</textarea>
                </div>
            </div>

            <div class="section-row">
                <div class="section-col reverse">
                    <button onclick="addBusiness()">UPDATE</button>
                </div>
            </div>
        </form>
    </div>
@endsection
