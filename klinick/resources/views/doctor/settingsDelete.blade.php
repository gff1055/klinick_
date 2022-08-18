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
	<h5 class="styleGeneral">Configurações</h5>
	<hr>

	<!--<div class="containerSettings" style="background-color: green">	-->
	<div class="container options" >
		
		<!--<div class="row">

			<div class="col-6">
				<button type="button" class="btn setOption" data-toggle="modal">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
						<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
						<path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0zM7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0z"/>
					</svg>
					<br>Alterar Dados
				</button>
			</div>

			<div class="col-6" >
					
				<button type="button" class="btn setOption" data-toggle="modal" id="btnDelete">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
						<path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z"/>
					</svg>
					<br>
					Excluir perfil medico
				</button>
					
			</div>
		</div>-->

		{!! Form::model($user, [
			'method' => 'delete',
			'class' => 'formUpdate'
		])
		!!}
		
			<h4> Confirme a sua senha</h4>
			<br><br>
			<b>ATENÇÃO: </b> Antes de prosseguir é necessário ressaltar que:
			<br><br>
			<ul>
				<li>Ao apagar o cadastro de médico, a sua conta não será apagada. Sendo assim, voce poderá continuar marcando consultas com outros médicos</li>
				<li>Antes de continuar, resolva qualquer tipo de pendencia que tenha com algum paciente</li>
				<li>Ao excluir esse cadastro, um novo só poderá ser feito depois de 90 dias</li>
						
			<br>
			<br>
			
			<span class="labelField"> Senha: </span>
			<span class="indicatorFieldRequired"></span>
			{!! Form::password('password', [
				'class' => 'atrForm',
				'placeholder' => 'Senha'
			]) !!}
		
			<br>
			<br>
			<br>
						
			<div class="divBtEnviar">
				{!!Form::submit('Desativar',[
					'class' => 'atrForm',
					//'id' => ''
				])
				!!}
			</div>
		
		{!!Form::close()!!}
		<br>
		<br>
	</div>


<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
<script>

	function thereIsPassword(pass){ return pass!=""; }
	
	$(function(){

	/**
	 * Funcao	: anonima associada com o evento de enviar(submeter) formulario
	 * Objetivo	: Fazer a validacao da senha e enviar a nova senha para atualizacao
	 */
		$('.formUpdate').submit(function(event){
			
			event.preventDefault();
			password = $('input[name="password"]').val();
			feedbackInputPassword = $('.indicatorFieldRequired');
			feedbackInputPassword.html("");

			if(!thereIsPassword(password)){
				alert("Senha nao digitada");
				return;
			}
			
			// Escopo da requisicao
			$.ajax({

				url: "/doctor/delete",
				type: "DELETE",
				data: $(this).serialize(),
				dataType: "json",

				/**
				 * Funcao	: success
				 * Objetivo	: validar os dados do formulario e fazer o cadastro
				 */
				success: function(answer){

					// Se houver sucesso na exclusao, o usuario é redirecionado para a tela de confirmação e saída
					// senão é exibida uma mensagem de preenchimento incorreto
					if(answer['success']){
						window.location.href = "/deactivated";
						//console.log(answer, "respondeu!!");
					}
					else{
						feedbackInputPassword.html("Senha inserida está incorreta");
						//console.log(answer,"nao respondeu");
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
@endsection