
password = document.getElementById('password');							// Campo de senha
checkPassword = document.getElementById('checkPassword');				// Campo de checagem de senha
submitUserRegister = document.getElementById('submitUserRegister');		// Elemento submit
submitUserRegister.disabled = true;										// Desabilitando o elemento submit
passwordWarning = document.getElementById('passwordWarning');			// Area de aviso de checagem de senha
inputBirthday = document.getElementById('inputBirthday');




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
	if(checkValue(password.value, checkPassword.value) == true){

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

	var rtrnValue;

	// Se os dados sao iguais, retorna true
	if(d1 == d2) rtrnValue = true;

	// Se os dados nao sao iguais retorna false
	else rtrnValue = false;
	
	return rtrnValue;
}


/*function dateConverter(date){
	return americanDate = date.split('/').reverse().join('/');
}*/




$(function(){

	/**
	 * Funcao: anonima associada com o evento de enviar(submeter) formulario
	 * Objetivo: Fazer a validacao das informações e o enviar o formulario para cadastro
	 */
	$('.formUserRegister').submit(function(event){

		event.preventDefault();
		blankFieldCounter = 0;						// Variavel que conta os campos que estao em branco
		var requiredField = $('.requiredField');	// Variavel que recebe a referencia dos campos obrigatorios do formulario
		var requiredFieldLabel = $('.requiredFieldLabel');

		// Percorre os campos obrigatorios do formulario para verificar se tem algum campo em branco
		for(var i = 0; i < requiredField.length; i++){
			
			// Se tiver um campo em branco ele é realçado em vermelho e
			// o contador de campos em branco incrementado
			if(requiredField[i].value == ""){
				requiredField[i].style.borderColor = "red";
				requiredFieldLabel[i].style.color = "red";
				blankFieldCounter++;
			}

			// Caso contrario o campo é realçado com o estilo original
			else
				requiredField[i].style.borderColor = "";
		}

		// Se existir campos em branco é exibido um alerta para o usuario
		if(blankFieldCounter)
			alert("Existem campos obrigatorios não preenchidos")
		
		// Se nao existir campos em branco a operacao de cadastro continua...
		else{

			feedbackUserName = $('#feedbackUserName');					// Exibe avisos sobre o username 
			feedbackEmail = $('#feedbackEmail'); 						// Exibe avisos sobre o Email 


			// Resetando a area de avisos no rotulo dos formularios
			//if(feedbackUserName[0].textContent!="") feedbackUserName.html("");
			if(feedbackEmail[0].textContent!="") feedbackEmail.html("");

			//inputBirthday.value = dateConverter(inputBirthday.value);	// Converte a data para o padrao americano (AAAA/MM/DD)
			

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
				success: function(answer){

					// Se a resposta da operacao for uma falha,
					// é verificado qual tipo de erro ocorreu
					//console.log(answer);
					if(answer[0].success==false){
						alert("Um ou mais campos possuem informações não válidas. Verifique")

						// O array de resposta é percorrido 
						// afim de coletar todos as mensagens de feedback
						for(var ind = 0; ind < answer.length; ind++){

							// Se o nome de usuario informado ja estiver sendo usado em outra conta,
							// os dados sao apagados no formulario e
							// é enviado um alerta para o usuario
							if(answer[ind].code == '55418313'){

								idInputUserName = $('#idInputUserName');
								idInputUserName.css("border-color","red");
								idInputUserName[0].value = "";

								feedbackUserName.css("color","red");
								feedbackUserName.html("  (ERRO: Já existe uma conta cadastrada com o nome de usuario informado. Digite outro)");
							}

							// O mesmo acontece com o email... 
							else if(answer[ind].code == '341313'){

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

				error: function(response){
					console.log(response);
				}
			});
		}
	});
})

