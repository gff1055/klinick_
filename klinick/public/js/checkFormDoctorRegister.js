





checkValue = function(d1, d2){return (d1 == d2);}


$(function(){

	/**
	 * Funcao: anonima associada com o evento de enviar(submeter) formulario
	 * Objetivo: Fazer a validacao das informações e o enviar o formulario para cadastro
	 */
	$('.formRegisterX').submit(function(event){
		event.preventDefault();

		/** Declaracoes d variaveis */

		
		/**Checar campos vazios */
		

		// Escopo da requisicao
			$.ajax({
				url: "#",
				type: "",
				data: $(this).serialize(),
				dataType: "json",

				/**
	 			* Funcao: success
	 			* Objetivo: validar os dados do formulario e fazer o cadastro
	 			*/
				success: function(answer)
				{
					// Se a resposta da operacao for uma falha,
					// é verificado qual tipo de erro ocorreu
					//console.log(answer);
					if(answer[0].success==false){			
					}

					// Se a resposta da operacao for sucesso,
					// o usuario é redirecionado para a	view do usuario 
					else window.location.href = "/user";
				},

				error: function(response){
					console.log(response);
				}
			});
	})
})

