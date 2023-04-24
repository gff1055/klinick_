
@if($userIsADoctor)
	@include('templates.topMenuBar.forUsers.registeredAsDoctor.layout', ["title" => $title])
	@include('templates.topMenuBar.forUsers.registeredAsDoctor.rightOption', ["title" => $title])
@else
	@include('templates.topMenuBar.forUsers.standard.layout', ["title" => $title])
	@include('templates.topMenuBar.forUsers.standard.rightOption', ["title" => $title])
@endif