// Campo de senha
password 					= document.getElementById('password');
// Campo de checagem de senha
checkPassword 				= document.getElementById('checkPassword');
// Elemento submit
submitUserRegister 			= document.getElementById('submitUserRegister');		
// Desabilitando o elemento submit
submitUserRegister.disabled = true;
// Area de aviso de checagem de senha
passwordWarning 			= document.getElementById('passwordWarning');

inputBirthday 				= document.getElementById('inputBirthday');



function fieldRequiredEmpty(field){if(field == "") return true; return false;}


checkPassword.addEventListener("keyup",

/**
 * Funcao: Anonima associada ao evento de pressionamento de tecla
 * Objetivo: Checar se a senha foi digitada corretamente nos campos 'senha' e 'confirmar senha'
 */
function(){
	feedbackPassword();
},false);




password.addEventListener("keyup",

/**
 * Funcao: Anonima associada ao evento de pressionamento de tecla
 * Objetivo: Checar se a senha foi digitada corretamente nos campos 'senha' e 'confirmar senha'
 */
function(){
	feedbackPassword();
},false);



feedbackPassword = function(){
	// Se a senha for igual nos dois campos,
	// testa novamente para saber se as senhas sao iguais de fato, ou se estão apenas em branco
	if(checkValue(password.value, checkPassword.value)){
		// Se os campos estiverem em branco, o botao de submit é desativado
		if(password.value == ""){
			submitUserRegister.disabled = true;
		}

		// Caso contrario, o botao de submit é ativado
		else{
			submitUserRegister.disabled = false;
			passwordWarning.innerHTML = "";
		}
	}

	// Se a senha nao foi digitada corretamente nos dois campos,
	// é exibido o alerta
	// e o botao de cadastro é desabilitado
	else if(checkValue(password.value, checkPassword.value) == false){
		submitUserRegister.disabled = true;
		passwordWarning.style.color = "#ff0000";
		passwordWarning.style.fontSize = "0.8em";
		passwordWarning.innerHTML = "*As senhas nao coincidem ou nao foram preenchidas<br>";
	}
}



/*
Funcao: 	checkValue
Objetivo: 	Testar se os valores passados sao iguais
Argumentos: dois valores
Retorno:
	true:	Os valores sao iguais
	false:	Os valores sao diferentes
*/

checkValue = function(d1, d2){
	if(d1 == d2) return true;
	else return false;	
}


function checkEmptyFieldRequired(pRequiredField, pRequiredFieldLabel){
	emptyFieldCounter = 0;						// Variavel que conta os campos que estao em branco
	for(var i = 0; i < pRequiredField.length; i++){
		if(fieldRequiredEmpty(pRequiredField[i].value)){
			pRequiredField[i].style.borderColor = "red";
			pRequiredField[i].style.borderWidth = "thin";
			pRequiredFieldLabel[i].style.color = "red";
			emptyFieldCounter++;
		}
		else{
			pRequiredField[i].style.borderColor = "";
			pRequiredField[i].style.borderWidth = "";
			pRequiredFieldLabel[i].style.color = "black";
		}
	}

	if(emptyFieldCounter) return true;
	else return false;
}


$(function(){

	/**
	 * Funcao: anonima associada com o evento de enviar(submeter) formulario
	 * Objetivo: Fazer a validacao das informações e o enviar o formulario para cadastro
	 */
	$('.formUserRegister').submit(function(event){
		event.preventDefault();
		
		var requiredField 		= $('.requiredField');	// Variavel que recebe a referencia dos campos obrigatorios do formulario
		var requiredFieldLabel 	= $('.requiredFieldLabel');


		if(checkEmptyFieldRequired(requiredField, requiredFieldLabel)){
			alert("Existem campos obrigatorios não preenchidos")
		}
		
		else{
			feedbackUserName = $('#feedbackUserName');					// Exibe avisos sobre o username 
			feedbackEmail = $('#feedbackEmail'); 						// Exibe avisos sobre o Email 


			// Resetando a area de avisos no rotulo dos formularios
			if(feedbackEmail[0].textContent!="") feedbackEmail.html("");

			// Escopo da requisicao
			$.ajax({
				url: "/user",
				type: "POST",
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
					if(answer[0].success==false)
					{			
						alert("Um ou mais campos possuem informações não válidas. Verifique");

						// O array de resposta é percorrido 
						// afim de coletar todos as mensagens de feedback
						for(var ind = 0; ind < answer.length; ind++)
						{
							// Se o nome de usuario informado ja estiver sendo usado em outra conta,
							// os dados sao apagados no formulario e
							// é enviado um alerta para o usuario
							if(answer[ind].code == '55418313')
							{
								idInputUserName = $('#idInputUserName');
								idInputUserName.css("border-color","red");
								idInputUserName[0].value = "";

								feedbackUserName.css("color","red");
								feedbackUserName.html("  (ERRO: Já existe uma conta cadastrada com o nome de usuario informado. Digite outro)");
							}

							// O mesmo acontece com o email... 
							else if(answer[ind].code == '341313')
							{
								idInputEmail = $('#idInputEmail');
								idInputEmail.css("border-color","red");
								idInputEmail[0].value = "";

								feedbackEmail.css("color","red");
								feedbackEmail.html("  (ERRO: Já existe uma conta cadastrada com o Email informado. Digite outro)");

							}

							// No caso de ocorrer outra falha...
							else console.log("FALHA GERAL....");
						}
					}

					// Se a resposta da operacao for sucesso,
					// o usuario é redirecionado para a	view do usuario 
					else window.location.href = "/user";
				},

				error: function(response)
				{
					console.log(response);
				}
			});
		}
	});
})

