
@php
	$title = 'Home';
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
	<link rel="stylesheet" href="{{asset('css/medForm/index.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.render', ["userIsADoctor" => $user->isADoctor])
	<div class="main-page-title">
		Minhas fichas de atendimento
	</div>

	<div class="container-fluid">
		
		<br>
		
		<div class="row">
			
		</div>


		<div class="row type-search-bar">

		
			<div class="container">
				<div class="row">
					<div class="col type-search-option leftmost-option">
						<button type="button" class="generalThemeColorUsers">Todos</button>
					</div>

					<div class="col type-search-option">
						<button type="button" class="generalThemeColorUsers">Em Espera</button>
					</div>

					<div class="col type-search-option">
						<button type="button" class="generalThemeColorUsers">Em Atendimento</button>
					</div>

					<div class="col type-search-option">
						<button type="button" class="generalThemeColorUsers">Concluidas</button>
					</div>
				</div>
			</div>


		</div>


		<div class="row">
			<div class="col">
				<h3 class="generalThemeColorUsers"> coluna</h3>
			</div>
		</div>


		<div class="row">

			<div class="col">
				<h3 class="generalThemeColorUsers"> coluna</h3>
			</div>

			<div class="col">
				<h3 class="generalThemeColorUsers"> coluna</h3>
			</div>

			<div class="col">
				<h3 class="generalThemeColorUsers"> coluna</h3>
			</div>

		</div>

	</div>


@endsection
