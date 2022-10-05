@php
	$title = 'Klinick Médicos - Cadastro';
@endphp



@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection


@section('content')

	@include('templates.topMenuBar.forUsers.standard.layout')
	@include('templates.topMenuBar.forUsers.standard.rightOption')

	<div class="formRegisterTitleLine"><br></div>

	<div class="container">

		{!! Form::open([
			//'route' => 'appointment.store',
			'class' => 'formRegister'
			])
		!!}

		<div class="row">
			
			<div class="col">

				<h3 class="generalThemeColorUsers">
					Nova consulta
				</h3>

				<br>		
				
				<span class="notice">
					Detalhe tudo o que está acontecendo (Sintomas, medicamentos já tomados, etc...). Quanto mais informações voce colocar, mais rápido um médico virá para o atendimento
				</span>
				
				{!! Form::textarea('description', null, [
					'class' => 'atrForm',
					'placeholder' => 'O que está acontecendo?',
					'rows' => "8"
				]) !!}
				
				<br>
				
				<div class="divBtEnviar">
					<a href={{route('user.index')}}>{!!Form::button('Voltar',[
							'class'	=> 'atrForm btn-light',
							'id' 	=> ''
						])!!}
					</a>
					
					{!!Form::submit('Enviar',[
						'class' => 'atrForm',
						'id' => 'submitUserRegister'
					])!!}
				</div>

		</div>
	</div>

		{!!Form::close()!!}

	</div>

@endsection

