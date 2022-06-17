
@php
	$isADoctor = $user->isADoctor;
@endphp

@if($user->isADoctor)
	@include('templates.topMenuBar.forUsers.registeredAsDoctor.layout')
	@include('templates.topMenuBar.forUsers.registeredAsDoctor.rightOption')
@else
	@include('templates.topMenuBar.forUsers.standard.layout')
	@include('templates.topMenuBar.forUsers.standard.rightOption')
@endif