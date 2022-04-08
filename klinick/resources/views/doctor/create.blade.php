@php
	$title = 'Klinick Médicos - Cadastro';
@endphp



@extends('templates.basic')


@section('content')

@include('templates.topMenuBar')

<div class="formRegisterTitleLine"><br></div>

	<div class="divUserRegisterForm">
		{!! Form::open([
			'route' => 'doctor.store',
			'class' => 'formRegister'
			])
		!!}

		
			<div class="formRegisterTitle">
				<br>
				<img src="/images/doctor.png" id="iconRegistDoctor">
				<br>
				<span class="logo">KliNicK Médicos</span>
				<br>
				Crie sua conta Médico Klinick e realize consultas.
				<br>
			</div>


			<br><br>
			<h5><b>Informações gerais</b></h5>
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
					{!! Form::text('crm', null, [
						'class' => 'atrForm requiredField',
						'placeholder' => 'N° CRM',
					]) !!}
				</div>
			</div>

			<br><br>
			<h5><b>Especialidades</b></h5>
			<br>


			<div class="row">
				<div class="col-8">
					<span class="notice"> Insira o nome da mesma forma que estã no registro CRM.</span>
				</div>
			</div>


			<div class="row">
				<div class="col-8">
					{!! Form::text('especialidade1', null, [
						'class' => 'atrForm',
						'placeholder' => 'Especialidade'
					]) !!}
				</div>
				<div class="col-4">
					{!! Form::text('rqe1', null, [
						'class' => 'atrForm',
						'placeholder' => 'Nº RQE'
					]) !!}
				</div>
			</div>
		

			<div class="row">
				<div class="col-8">
					{!! Form::text('especialidade2', null, [
						'class' => 'atrForm',
						'placeholder' => 'Especialidade'
					]) !!}
				</div>
				<div class="col-4">
					{!! Form::text('rqe2', null, [
						'class' => 'atrForm',
						'placeholder' => 'Nº RQE'
					]) !!}
				</div>
			</div>


			<div class="row">
				<div class="col-8">
					{!! Form::text('especialidade3', null, [
						'class' => 'atrForm',
						'placeholder' => 'Especialidade'
					]) !!}
				</div>
				<div class="col-4">
					{!! Form::text('rqe3', null, [
						'class' => 'atrForm',
						'placeholder' => 'Nº RQE'
					]) !!}
				</div>
			</div>


			<br>
			<b>Atenção: </b> Seu cadastro será avaliado e sujeito à elegibilidade. Em caso de reprovação, o cadastro deverá ser feito novamente só depois de 90 dias.
			<br>


			<div class="divBtEnviar">
				<a href={{route('user.index')}}>{!!Form::button('Voltar',[
					'class' => 'atrForm btn-light',
					'id' => ''
					])
				!!}</a>
				{!!Form::submit('Criar conta',[
					'class' => 'atrForm btn-success',
					'id' => 'submitUserRegister'
				])
				!!}
			</div>
			
			<br>
			
			<div class="formRegisterTitle">
				Ao me cadastrar eu concordo com os <a href="">termos e usos</a> da KliNick Serviços Medicos
			</div>
			
			<br>


		{!!Form::close()!!}
		<div class="formRegisterTitleLine"><br></div>
		(c) Direitos reservados
	</div>
	
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
	<script src="{{asset('js/checkFormDoctorRegister.js')}}"></script>
@endsection