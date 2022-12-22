
@if($userIsADoctor)
	@include('templates.topMenuBar.forUsers.registeredAsDoctor.layout')
	@include('templates.topMenuBar.forUsers.registeredAsDoctor.rightOption')
@else
	@include('templates.topMenuBar.forUsers.standard.layout')
	@include('templates.topMenuBar.forUsers.standard.rightOption')
@endif