@php
	$title = 'Home';
@endphp

@extends('templates.basic')

@section('content')

	@include('templates.topMenuBar')

	@php
	echo "ola ".$name;	
	@endphp

@endsection

