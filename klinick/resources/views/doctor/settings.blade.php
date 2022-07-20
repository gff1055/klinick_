@php
	$title = 'Configuracoes';
@endphp

@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForDoctors.css')}}">
	<link rel="stylesheet" href="{{asset('css/doctorSettings.css')}}">
@endsection

@section('content')

	@include('templates.topMenuBar.forDoctors.layout')
	@include('templates.topMenuBar.forDoctors.rightOption')

	<br>
	TESTE
	<hr>
	<br>
	<div class="containerSettings" style="background-color: tgreen">	
		<div class="container options" >
		
			<div class="row align-items-center" style="background-color: tred">

				<div class="col-2">
				</div>

				<div class="col-8" style="background-color: tblue">
					<a class="btn btn-primary">Alterar Dados</a>
				</div>

				
				<div class="col-2">
				</div>
		
		
			</div>
			
			<br><br>

			<div class="row align-items-center" style="background-color: tred">

				<div class="col-2">
				</div>

				<div class="col-8" style="background-color: tblue">
					<a class="btn btn-primary ">Excluir perfil de medico</a>
				</div>

				
				<div class="col-2">
				</div>
		
		
			</div>
		</div>
	</div>



@endsection