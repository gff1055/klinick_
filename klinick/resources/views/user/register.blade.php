@php
	$title = 'Cadastro';
@endphp



@extends('templates.basic')


@section('content')

	<section class="topMenuBar">
		<div class="itemTopMenuBar"><span class="logo">KlinicK</span></div>
		<div class="itemTopMenuBar"><a href="#">Seguranca</a></div>
		<div class="itemTopMenuBar"><a href="#">Ajuda</a></div>
		<div class="itemTopMenuBar"><a href="#">Contato</a></div>
	</section>

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
		<span class="requiredFieldLabel">*Campo obrigatorio</span>
		{!! Form::text('name', null, [
			'class' => 'atrForm requiredField',
			'placeholder' => 'Nome'
		]) !!}


		<br>
		<br>
		<span class="requiredFieldLabel" id="idLabelUserName">*Campo obrigatorio </span>
		<span class="requiredFieldLabel" id="feedbackUserName"></span>
		
		{!! Form::text('username', null, [
			'class' => 'atrForm requiredField',
			'placeholder' => 'Usuario',
			'id' => 'idInputUserName'
		]) !!}

		<br><br><span id="passwordWarning"></span>
		{!! Form::password('password', [
			'class'=>'atrForm atrFormSizeHalf',
			'id' => 'password',
			'placeholder'=>'Senha'
		]) !!}

		{!! Form::password('checkPassword', [
			'class'=>'atrForm atrFormSizeHalf',
			'id' => 'checkPassword',
			'placeholder'=>'Confirmar senha'
		]) !!}

		<br><br>
		<span class="requiredFieldLabel" id="idLabelEmail">*Campo obrigatorio </span>
		<span class="requiredFieldLabel" id="feedbackEmail"></span>
		{!! Form::text('email', null, [
			'class' => 'atrForm requiredField',
			'placeholder' => 'Email',
			'id' => 'idInputEmail'
		]) !!}
		
		<br><br>
		{!! Form::text('dataNasc', null, [
			'class' => 'atrForm atrFormSizeHalf',
			'placeholder' => 'Data de Nascimento'
		]) !!}

		{!!Form::Label('sexo', 'Sexo: ')!!}
		{!! Form::select('sexo', array(
			'masculino' => 'Masculino',
			'feminino' => 'Feminino'
		),[
			'class'=>'atrForm',
		]) !!}

		<br><br><span class="requiredFieldLabel">*Campo obrigatorio</span>
		{!! Form::text('phone', null, [
			'class' => 'atrForm requiredField',
			'placeholder' => 'Fone'
		]) !!}

		<div class="divBtEnviar">
		{!!Form::submit('Criar conta',[
			'class' => 'atrForm',
			'id' => 'submitUserRegister'
		])
			!!}
		</div>
		<br>
		<div class="formUserRegisterTitle">Ao me cadastrar eu concordo com os <a href="">termos e usos</a> da KliNick Serviços Medicos</div>
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
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
	<script src="{{asset('js/checkFormRegister.js')}}"></script>
	</div>
@endsection