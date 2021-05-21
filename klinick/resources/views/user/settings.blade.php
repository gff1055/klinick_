@php
	$title = "Configuracoes"
@endphp

@extends("templates.basic")

@section("content")
	@extends('templates.topMenuBar')


<div class="configurationArea layoutArea">
	<nav class="configurationSideMenu">
		<ul>
			<a href="#"><li class="configurationSideMenuOption ">Informacoes pessoais</li></a>
			<a href="#"><li class="configurationSideMenuOption ">Login e Segurança</li></a>
			<a href="#"><li class="configurationSideMenuOption ">Desativar conta</li></a>
		</ul>
	</nav>
	
	<div class="configurationContent">
		conteudo
	</div>
</div>
@endsection