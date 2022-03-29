

inputMenuSandwich = document.getElementById("inputMenuSandwich");		// referencia do checkbox para fechar abrir o menu
body = document.getElementsByTagName("body")[0];						// referencia do body do documento
menuToggle = document.getElementById("menuToggle");						// referencia do menu
menu = document.getElementById("menu");
buttonExitUser = document.getElementsByClassName("buttonExitUser")[0];
flagCloseMenuBar = true;												// flag que indica se o menu esta aberto ou nao
optionBeDoctor = document.querySelector("#optionBeDoctor .btn");
modal = document.getElementsByClassName("mdl")[0];
screenMdl = document.getElementsByClassName("screenMdl")[0];
modalBotaoOk = document.getElementsByClassName("buttonOk")[0];



function clickLeaveModal(event){
	return (
		event.target.className.indexOf("screenMdl") != -1
		|| event.target.className.indexOf("mdlClose") != -1
		|| event.target.className.indexOf("buttonExit") != -1
	);
}


function clickContinueModal(event){
	return event.target.className.indexOf("buttonOk") != -1;
}



/** Funcao impede o evento 'click' ser acionado no body e o menu fechar */
menu.addEventListener("click", function(e){
	e.stopPropagation();
}, false);


/** Funcao impede o evento 'click' ser acionado no body e o menu fechar */
inputMenuSandwich.addEventListener("click", function(e){
	e.stopPropagation();
}, false);


/** Evento no body é acionado e o menu suspenso é fechado */
body.addEventListener("click", function(e){
	inputMenuSandwich.checked = false;
});


/** Evento no botao para sair do site */
buttonExitUser.addEventListener("click", function(e){
	if(!confirm("Tem certeza que deseja efetuar logout nessa conta?")){
		e.preventDefault();
		inputMenuSandwich.checked = false;
	}
});

/** Evento de clique no botao de cadastro de medico */
optionBeDoctor.addEventListener("click", function(e){
	modal.style.display = "block";
	screenMdl.style.display = "block";
});



/**
 * FUNCAO:		handleModal
 * OBJETIVO:	administrar o comportamento do modal
 * PARAMETROS:	evento gerado
 * RETORNO: 
 */
function handleModal(event){

	if(clickLeaveModal(event)){
		screenMdl.style.display = "none";
	}

	else if(clickContinueModal(event)){
		window.location.href = "/doctor/agreement";
	}
}


screenMdl.addEventListener("click",function(event){
	handleModal(event);		
});

