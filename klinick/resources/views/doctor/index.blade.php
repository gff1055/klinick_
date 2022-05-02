@php
	$title = 'Meu consultorio';
@endphp

@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForDoctors.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBarDoctors')


@endsection
