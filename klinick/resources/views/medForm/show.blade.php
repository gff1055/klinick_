@php
	$title = 'Ficha de atendimento';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection

@section('content')


{{ $dataMedForm->id }}
{{ $dataMedForm->user_id }}
{{ $dataMedForm->date }}
{{ $dataMedForm->state }}
{{ $dataMedForm->city }}
{{ $dataMedForm->complaint }}
{{ $dataMedForm->paymentMode }}
{{ $dataMedForm->status }}

@endsection
