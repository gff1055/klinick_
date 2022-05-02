@php
	$title = "Configuracoes"
@endphp

@extends('templates.basic')


@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForUsers.css')}}">
@endsection



@section("content")
	
	@include('templates.topMenuBar')


<div class="container-fluid">
	<div class="row">
		<div class="col divOptionSettingMenu" id="divOptionSettingMenuSelected">
			<div>
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
					<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
				</svg>
			</div>
			<div>
				<span class="optionSettingMenu">Dados pessoais</span>
			</div>
		</div>

		<div class="col divOptionSettingMenu">
			<a href="{{route('user.settingsAuthData')}}">
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-lock-fill" viewBox="0 0 16 16">
						<path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
					</svg>
				</div>
				<div>
					<span class="optionSettingMenu">Segurança</span>
				</div>
			</a>
		</div>

		<div class="col divOptionSettingMenu">
			<a href="{{route('user.settingsDelete')}}">
			<div>
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
					<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
				</svg>
			</div>
			<div>
				<span class="optionSettingMenu">Excluir conta</span>
			</div>
			</a>
		</div>

	</div>

	{!! Form::model($user, [
		/*'route' => [
			'user.update',
			$user->id
		],*/
		'method' => 'put',
		'class' => 'formUpdate'
	])
	!!}
	
		<span class="labelField"> Nome: </span>
		<br>
		<span class="notice">
			Este nome será exibido no chat ao conversar com seu paciente/médico e tambem será exibido no seu perfil de médico
		</span>
		{!! Form::text('name', $user->name, [
				'class' => 'atrForm',
		]) !!}

		<br><br><br>
		
		<span class="labelField"> Email: </span>
		<span class="indicatorFieldRequired"></span>
		{!! Form::text('email', $user->email, [
				'class' => 'atrForm',
		]) !!}

		<br><br><br>	
		
		<span class="labelField"> Telefone: </span>
		<br>
		{!! Form::text('phone', $user->phone, [
				'class' => 'atrForm',
		]) !!}
		
		<br><br><br>
					
		<span class="labelField"> Sexo: </span>
		<br>
		{!! Form::select('sexo', array(
				'masculino' => 'Masculino',
				'feminino' => 'Feminino'
			),
			$user->sexo,
			[
				'class'=>'atrForm',
		]) !!}

		<br><br>

		<div class="divBtEnviar">
			<a href={{route('user.index')}}>
				{!!Form::button('Voltar',[
					'class' => 'atrForm btn-light',
					'id' => ''
				])!!}
			</a>
			{!!Form::submit('Atualizar',[
				'class' => 'atrForm',
				'id' => ''
			])
			!!}
		</div>

	{!!Form::close()!!}
	<br><br>
		
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>
	$(function(){

	/**
	 * Funcao	: anonima associada com o evento de enviar(submeter) formulario
	 * Objetivo	: Fazer a validacao das informações e o enviar o formulario para cadastro
	 */
		$('.formUpdate').submit(function(event){

			event.preventDefault();

			// Escopo da requisicao
			$.ajax({

				url: "/user/updating/personal_data",
				type: "PUT",
				data: $(this).serialize(),
				dataType: "json",

				/**
				 * Funcao	: success
				 * Objetivo	: validar os dados do formulario e fazer o cadastro
				 */
				success: function(answer){

					feedbackUpdateEmail = $('.indicatorFieldRequired');

					// Se nao houve sucesso na atualizacao
					// é verificado...					
					if(!answer['success']){

						// ... se houve erro no email
						if(answer['code'] == '341313'){

							feedbackUpdateEmail.html("Este email ja foi cadastrado por alguem! Escolha outro");

						}

						// ... ou ocorreu um erro desconhecido
						else{

							feedbackUpdateEmail.html("ERRO");

						}

					}

					// Se houve sucesso
					// é exibida uma mensagem na tela
					// e o usuario é redirecionado para a pagina principal
					else{

						alert("Dados atualizados")
						window.location.href = "/user";
						
					}

				},

				error: function(response){
					console.log(response);
				}
			});
		});
	})
</script>
@endsection