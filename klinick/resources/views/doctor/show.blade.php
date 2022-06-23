@php
	$title = 'Nome do medico';
	echo($doctor->);
@endphp

@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection

@section('content')
	@include('templates.topMenuBar.render', ["user" => $user ?? 0])
	$doctor->id
	$doctor->user_id
	$doctor->registeredName
	$doctor->numberCrm
	$doctor->nameSpecialty1
	$doctor->numberRqe1
	$doctor->nameSpecialty2
	$doctor->numberRqe2
	$doctor->nameSpecialty3
	$doctor->numberRqe3
	$doctor->description
	$doctor->modePayment	
@endsection