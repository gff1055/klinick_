/*
Arquivo que valida a entrada do usuario no sistema.
Se houver exito, passa para a pagina inicial.
Senao é exibida uma mensagem de erro
*/

$(function()
{

	/**
	 * FUNCAO:		anonima
	 * OBJETIVO:	validar o email e senha digitados pelo usuario
	 * ARGUMENTOS:	objeto associado ao evento 'submit'
	 * RETORNO:
	 */
	$('.formLogin').submit(function(event)
	{

		event.preventDefault();					// Prevenindo o comportamento padrao do botao submit
		
		// Escopo da requisicao ajax
		$.ajax(
		{
			url: "/login",						// Endereco onde sera enviada a requisicao
			type: "post",						// Tipo de envio
			data: $(this).serialize(),			// Dados (serializados) a serem enviados
			dataType: 'json',					// Tipo dos dados

			// Funcao a ser executada em caso de sucesso no envio da requisicao
			success: function(response)
			{
				// Se os dados de login conferem
				// o usuario é direcionado para a pagina
				if(response.success === true)
				{
					window.location.href = "/user";
				}

				// Se os dados de login nao conferem, 
				// é exibido o feedback
				else
				{
					$('#feedbackLogin').removeClass("d-none").html(response.message);
					$('#feedbackLogin').css("color","red");
					$('#feedbackLogin').css("background-color","pink");
				}
			},

			error: function(response)
			{
				console.log(response);
			}
		});
	});
});