@php
	$title = 'Klinick Médicos - Cadastro';
@endphp



@extends('templates.basic')


@section('content')

@include('templates.topMenuBar')

<div class="formUserRegisterTitleLine"><br></div>	

	<div class="divUserRegisterForm">
		{!! Form::open([
			'route' => 'user.store',
			'class' => 'formUserRegister'
			])
		!!}

	
			<div class="formUserRegisterTitle">
				<span class="logo">KliNicK</span>
				<br>
				Crie sua conta e faça consultas com medicos on-line de varias especialidades
				<br>
			</div>
			
			<br><br>

			<h5>Informações gerais</h5>

			<br>

			<div class="row">
				<div class="col-8">
					<span class="notice"> Insira o nome da mesma forma que estã no registro CRM.</span>
				</div>
			</div>

			<div class="row">
				<div class="col-8">
					{!! Form::text('name', null, [
						'class' => 'atrForm requiredField',
						'placeholder' => 'Nome'
					]) !!}
				</div>

				<div class="col-4">
					{!! Form::text('email', null, [
						'class' => 'atrForm requiredField',
						'placeholder' => 'N° CRM',
						'id' => 'idInputEmail'
					]) !!}
				</div>
			</div>

			<br><br>
			<h5>Especialidades</h5>
			<br>

			<div class="row">
				<div class="col-8">
					{!! Form::text('phone', null, [
						'class' => 'atrForm',
						'placeholder' => 'Especialidade'
					]) !!}
				</div>
				<div class="col-4">
					{!! Form::text('phone', null, [
						'class' => 'atrForm',
						'placeholder' => 'Nº RQE'
					]) !!}
				</div>
			</div>

			<div class="row">
				<div class="col-8">
					{!! Form::text('phone', null, [
						'class' => 'atrForm',
						'placeholder' => 'Especialidade'
					]) !!}
				</div>
				<div class="col-4">
					{!! Form::text('phone', null, [
						'class' => 'atrForm',
						'placeholder' => 'Nº RQE'
					]) !!}
				</div>
			</div>


			<div class="row">
				<div class="col-8">
					{!! Form::text('phone', null, [
						'class' => 'atrForm',
						'placeholder' => 'Especialidade'
					]) !!}
				</div>
				<div class="col-4">
					{!! Form::text('phone', null, [
						'class' => 'atrForm',
						'placeholder' => 'Nº RQE'
					]) !!}
				</div>
			</div>
			
			<br>

			<div class="divBtEnviar">
					<a href={{route('user.index')}}>{!!Form::button('Home',[
							'class' => 'atrForm',
							'id' => ''
						])
						!!}</a>
				{!!Form::submit('Criar conta',[
					'class' => 'atrForm',
					'id' => 'submitUserRegister'
				])
				!!}
			</div>
			<br>
			<div class="formUserRegisterTitle">
				Ao me cadastrar eu concordo com os <a href="">termos e usos</a> da KliNick Serviços Medicos
			</div>
			<br>

<!--
		nome - 		input text
		login - 	--
		password - 	password
		email -		input text
		sexo -		combobox
		*rua -		input text
		*bairro -	--
		*num -		--
		*compl - 	--
		*estad -		--
		*cidad -		--
		*dataNasc -	--
		whatsapp -	--
		phone -		--

	-->	

		{!!Form::close()!!}
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
	<script src="{{asset('js/checkFormRegister.js')}}"></script>
@endsection