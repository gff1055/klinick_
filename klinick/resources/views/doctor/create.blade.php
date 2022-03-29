@php
	$title = 'Cadastro';
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
		
			<br>
			<span class="indicatorFieldRequired">*</span>
			<span class="labelField">Nome </span>
			<br>
			<span class="notice"> Use seu nome e sobrenome, pois o mesmo será visivel no chat ao conversar com seu médico. E será exibido no seu perfil de médico.</span>
			{!! Form::text('name', null, [
				'class' => 'atrForm requiredField',
				'placeholder' => 'Nome'
			]) !!}


			<!--<span class="indicatorFieldRequired">*</span>
			<span class="labelField" id="idLabelUserName">Nome de usuario </span>
			<span class="requiredFieldLabel" id="feedbackUserName"></span>
		
			{!! /*Form::text('username', null, [
				'class' => 'atrForm requiredField',
				'placeholder' => 'Usuario',
				'id' => 'idInputUserName'
			])*/"teste" !!}-->

			<br><br>
			<span class="indicatorFieldRequired">*</span>
			<span class="labelField">Senha</span>
			<br>
			<span id="passwordWarning"></span>
			{!! Form::password('password', [
				'class'=>'atrForm  requiredField atrFormSizeHalf',
				'id' => 'password',
				'placeholder'=>'Senha'
			]) !!}
			<br><br>
			<span class="indicatorFieldRequired">*</span>
			<span class="labelField">Confirmar senha</span>
			{!! Form::password('checkPassword', [
				'class'=>'atrForm atrFormSizeHalf',
				'id' => 'checkPassword',
				'placeholder'=>'Confirmar senha'
			]) !!}

			<br><br>
			<span class="indicatorFieldRequired">*</span>
			<span class="labelField" id="idLabelEmail">Email </span>
			<span class="labelField" id="feedbackEmail"></span>
			{!! Form::text('email', null, [
				'class' => 'atrForm requiredField',
				'placeholder' => 'Email',
				'id' => 'idInputEmail'
			]) !!}
		
			<!--<span class="labelField">Data de nascimento </span>
			{!! /*Form::text('dataNasc', null, [
				'class' => 'atrForm atrFormSizeHalf',
				'id' => 'inputBirthday',
				'placeholder' => 'Data de Nascimento (dia/mes/ano)'
			])*/"teste" !!}-->

			<br><br>
			<span class="labelField">Sexo: </span>
			{!! Form::select('sexo', array(
				'masculino' => 'Masculino',
				'feminino' => 'Feminino'
			),[
				'class'=>'atrForm',
			]) !!}	

			<br><br>
			<span class="labelField">Fone</span><br>
			<span class="notice">O numero de telefone não será visivel para outros usuarios</span>
			{!! Form::text('phone', null, [
				'class' => 'atrForm requiredField',
				'placeholder' => 'Fone'
			]) !!}

			<br><br>
			<span class="labelField">Campos indicados com </span>
			<span class="indicatorFieldRequired">*</span>
			<span class="labelField"> são de preenchimento obrigatorio</span>
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