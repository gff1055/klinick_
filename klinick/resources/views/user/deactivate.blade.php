@php
	$title = "Configuracoes"
@endphp

@extends("templates.basic")

@section("content")
	@extends('templates.topMenuBar')


<div class="container-fluid">
	<div class="row">
		<div class="col divAccountDeleted">
			<a href="#">
				<div>
					<br>
					<br>
					<br>
					<svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" fill="#666666" class="bi bi-emoji-frown" viewBox="0 0 16 16">
						<path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
						<path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
					  </svg>
				</div>
				<div>
					<br>
					<span class="aoptionSettingMenu">Sua conta foi deletada! <br> Clique para ir para a página inicial</span>
					<br>
					<br>
					<br>
				</div>
			</a>
		</div>
	</div>

	
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
			password = $('input[name="password"]').val();
			feedbackInputPassword = $('.indicatorFieldRequired');
			feedbackInputPassword.html("");

			// Verifica o preenchimento da senha
			if(password == ""){
				alert("Senha nao digitada");
				return;
			}
			
			// Escopo da requisicao
			$.ajax({

				url: "/user/delete",
				type: "DELETE",
				data: $(this).serialize(),
				dataType: "json",

				/**
				 * Funcao	: success
				 * Objetivo	: validar os dados do formulario e fazer o cadastro
				 */
				success: function(answer){
					if(answer['success']){
						window.location.href = "/login";
						//console.log(answer);
					}
					else{
						feedbackInputPassword.html("Senha inserida está incorreta");
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