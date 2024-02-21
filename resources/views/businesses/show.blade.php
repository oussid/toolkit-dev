@extends('layouts.main')
@section('content')

{{-- breadcrum --}}
<x-breadcrum :data="$breadcrum" />

{{-- business show card --}}
@livewire('single-business-card', ['business' => $business], key($business->id))

@endsection
{{-- CARDS SCRIPT --}}
<script src="{{asset('js/card.js')}}" defer></script>
