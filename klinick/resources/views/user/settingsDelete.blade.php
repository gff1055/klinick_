@php
	$title = "Configuracoes"
@endphp

@extends("templates.basic")

@section("content")
	@extends('templates.topMenuBar')


<div class="container-fluid">
	<div class="row">
		<div class="col divOptionSettingMenu">
			<a href="{{route('user.settingsPersonalData')}}">
				<div>
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-person-lines-fill" viewBox="0 0 16 16">
						<path d="M6 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm-5 6s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zM11 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 0 0 1h4a.5.5 0 0 0 0-1h-4zm2 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2zm0 3a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1h-2z"/>
					</svg>
				</div>
				<div>
					<span class="optionSettingMenu">Dados pessoais</span>
				</div>
			</a>
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
		<div class="col divOptionSettingMenu" id="divOptionSettingMenuSelected">
			<div>
				<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#eeeeee" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
					<path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
				</svg>
			</div>
			<div>
				<span class="optionSettingMenu">Desativar conta</span>
			</div>
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
	
	<span class="labelField"> Senha atual: </span>
	<span class="indicatorFieldRequired"></span>
	</span>
		{!! Form::password('password', [
			'class' => 'atrForm',
		]) !!}

	<br>
	<br>
	<br>
	<span class="labelField"> Nova senha: </span>
		</span>
		{!! Form::password('newPassword', [
				'class' => 'atrForm',
		]) !!}
		
		<br>
		<br>
		<br>
				
		<span class="labelField"> Confirmar nova senha: </span>
		<br>
		{!! Form::password('checkNewPassword', [
			'class' => 'atrForm',
		]) !!}
		
		<br>
		<br>
		<br>
					
		<div class="divBtEnviar">
			<a href={{route('user.index')}}>
				{!!Form::button('Voltar',[
					'class' => 'atrForm',
					//'id' => ''
				])!!}
			</a>
			{!!Form::submit('Atualizar',[
				'class' => 'atrForm',
				//'id' => ''
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
	 * Objetivo	: Fazer a validacao da senha e enviar a nova senha para atualizacao
	 */
		$('.formUpdate').submit(function(event){
			
			event.preventDefault();
			newPassword 		= $('input[name="newPassword"]').val();
			checkNewPassword 	= $('input[name="checkNewPassword"]').val();
			
			// Verifica o preenchimento da nova senha
			if(newPassword == ""){

				alert("A nova senha nao foi inserida");
				return;

			}
			
			// Verifica se a nova senha foi checada
			else if(newPassword != checkNewPassword){

				alert("As senhas não correspondem");
				return;

			}
			
			// Escopo da requisicao
			$.ajax({

				url: "/user/updating/auth_data",
				type: "PUT",
				data: $(this).serialize(),
				dataType: "json",

				/**
				 * Funcao	: success
				 * Objetivo	: validar os dados do formulario e fazer o cadastro
				 */
				success: function(answer){

					feedbackUpdateEmail = $('.indicatorFieldRequired');
					
					// Se nao houve sucesso na atualizacao,
					// é verificado ...
					if(!answer['success']){
					
						// ... se a senha está incorreta ou...
						if(answer['code'] == '341834'){
					
							feedbackUpdateEmail.html("Senha incorreta!");
					
						}
					
						// ... se houve outro erro
						else{
					
							feedbackUpdateEmail.html("ERRO");
					
						}
					
					}

					// Se houver sucesso na atualizacao
					// é enviada uma mensagem na tela e 
					// o usuario é redirecionado para a pagina inicial
					else{
						alert("A senha foi atualizada")
						window.location.href = "/user";
					}
				},

				// Erro na requisicao
				error: function(response){
					console.log(response);
				}
			});

		});
	})
</script>
<!--<script src="{{asset('js/updateDataPersonal.js')}}"></script>-->
@endsection