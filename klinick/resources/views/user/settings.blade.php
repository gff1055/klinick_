@php
	$title = "Configuracoes"
@endphp

@extends("templates.basic")

@section("content")
	@extends('templates.topMenuBar')


<div class="container-fluid">
<!--	<nav class="row">
		<ul>
			<a href="#"><li class="configurationSideMenuOption ">Informacoes pessoais</li></a>
			<a href="#"><li class="configurationSideMenuOption ">Login e Segurança</li></a>
			<a href="#"><li class="configurationSideMenuOption ">Desativar conta</li></a>
		</ul>
	</nav>
	
	<div class="configurationContent">
		conteudo
	</div>-->
	<div class="row">
		<div class="col divOptionSettingMenu">
			<div>
			<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
				<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
			  </svg>
			</div>
			<div>
			  <span class="s">Dados pessoais</span>
			</div>
		</div>
		<div class="col divOptionSettingMenu">
			<div>
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-lock-fill" viewBox="0 0 16 16">
					<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
				</svg>
			</div>
			<div>
				<span class="s">Login e Segurança</span>
			</div>
		</div>
		<div class="col divOptionSettingMenu">
			<div>
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
					<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
				</svg>
			</div>
			<div>
				<span class="s">Desativar conta</span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col">
			<span class="labelField"> Nome: </span>
			<br>
			{{$user->name}}
			<br><br><br>

			<span class="labelField"> Telefone: </span>
			<br>
			{{$user->phone}}
			<br><br><br>
		</div>
	
		<div class="col">
			<span class="labelField"> Sexo: </span>
			<br>
			{{$user->sexo}}
			<br><br><br>
	
			
	
			<span class="labelField"> Nascimento: </span>
			<br>
			{{$user->dataNasc}}
			<br><br><br>

		</div>
	</div>
</div>
@endsection