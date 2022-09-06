@php
	$title = 'Configuracoes';
@endphp

@extends('templates.basic')

@section('loadingCss')
	<link rel="stylesheet" href="{{asset('css/themeForDoctors.css')}}">
	<link rel="stylesheet" href="{{asset('css/doctorSettings.css')}}">
@endsection

<div class="mdl modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">CONFIRMAÇÃO:</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
				Deseja continuar com o processo de exclusao da conta médico?
			</div>
		
			<div class="modal-footer">
				<button type="button" class="btn colorTheme buttonOk" id="btnOkDeleteModal">Sim</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnCancelDeleteModal">Cancelar exclusão</button>
			</div>
		</div>
	</div>
</div>

<button type="button" id="btnActiveModalDelete" class="btn" data-toggle="modal" data-target="#deleteConfirmModal" hidden>
</button>

@section('content')

	@include('templates.topMenuBar.forDoctors.layout')
	@include('templates.topMenuBar.forDoctors.rightOption')

	<br>
	<h5 class="styleGeneral">Configurações</h5>
	<hr>

	<!--<div class="containerSettings" style="background-color: green">	-->
	<div class="container options" >
				
		{!! Form::model($user, [
			'method' 	=> 'delete',
			'class' 	=> 'formUpdate'
		])
		!!}
					
			<h4> <b>Você está desativando o seu perfil de médico</b></h4>
			<br><br>
			<span class="notice">
			<b>ATENÇÃO: </b> Antes de prosseguir é necessário ressaltar que:
			<br><br>
			<ul>
				<li>Ao apagar o cadastro de médico, a sua conta não será apagada. Sendo assim, voce poderá continuar marcando consultas com outros médicos</li>
				<li>Antes de continuar, resolva qualquer tipo de pendencia que tenha com algum paciente</li>
				<li>Ao excluir esse cadastro, um novo só poderá ser feito depois de 90 dias</li>
						
			</ul>
			</span>
			<br>
			<span class="labelField"> Senha: </span>
			<span class="indicatorFieldRequired"></span>
			{!! Form::password('password', [
				'class' 		=> 'atrForm',
				'placeholder' 	=> 'Senha'
			]) !!}
		
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
<script src="{{asset('js/settingsDeleteDoctor.js')}}"></script>
<script>

	function thereIsPassword(pass){ return pass!=""; }
	function deletionConfirmed(){}

	btnActiveModalDelete = document.getElementById("btnActiveModalDelete");
	
	
	
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

			else{

				continueDelete = confirm("Deseja continuar com o processo de exclusao da conta médico?");

				if(continueDelete){

					// Escopo da requisicao
					$.ajax({

						url:		"/doctor/delete",
						type:		"DELETE",
						data:		$(this).serialize(),
						dataType:	"json",

						/**
						 * Funcao	: success
						 * Objetivo	: validar os dados do formulario e fazer o cadastro
						 */
						success: function(answer){

							if(answer['success']){
								window.location.href = "/user";
								console.log(answer, "respondeu!!");
							}
							else{
								feedbackInputPassword.html("Senha inserida está incorreta");
								console.log(answer,"nao respondeu");
							}
						},

						// Erro na requisicao
						error: function(response){
							console.log(response);
						}
					});
				}
			}			
		});	
	})
</script>
@endsection