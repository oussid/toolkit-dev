@extends('layouts.main')

@section('content')
<x-breadcrum :data="$breadcrum" />
{{-- invoices table --}}
<x-table :props="$tableProps" />
@endsection