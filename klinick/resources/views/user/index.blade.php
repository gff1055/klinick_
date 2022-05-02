@php
	$title = 'Home';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar')
	@include('templates.loadUserRightOption')

	@php
	echo "ola ".$name;	
	@endphp

@endsection

