



$(function(){

	/**
	 * Funcao	: anonima associada com o evento de enviar(submeter) formulario
	 * Objetivo	: Fazer a validacao das informações e o enviar o formulario para cadastro
	 */
	$('.formUpdate').submit(function(event){

		event.preventDefault();
		console.log($(this));
		// Escopo da requisicao
		$.ajax({
			url: "/user", *OFF USE ESSE EVENTO DENTRO DA PAGINA DE ATUALIZACAO
			type: "POST",
			data: $(this).serialize(),
			dataType: "json",

			/**
 			* Funcao	: success
 			* Objetivo	: validar os dados do formulario e fazer o cadastro
 			*/
				success: function(answer){
					window.location.href = "/user";
				},

				error: function(response){
					//console.log(response);
				}
		});
	});
})