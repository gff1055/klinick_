@php
	$title = 'Home';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.render', ["user" => $user])

	@php
	echo "ola ".$user->name;	
	@endphp

@endsection

