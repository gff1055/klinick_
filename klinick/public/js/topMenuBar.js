

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



buttonExitUser.addEventListener("click", function(e){
	if(!confirm("Tem certeza que deseja efetuar logout nessa conta?")){
		e.preventDefault();
		inputMenuSandwich.checked = false;
	}
});


optionBeDoctor.addEventListener("click", function(e){
	modal.style.display = "block";
	screenMdl.style.display = "block";
});


function houveCliqueParaSair(evento){
	if(
		evento.target.className.indexOf("screenMdl") != -1
		|| evento.target.className.indexOf("mdlClose") != -1
		|| evento.target.className.indexOf("buttonExit") != -1
	){
		return true;
	}
	return false;
}


function gerenciaModal(evento){
	if(houveCliqueParaSair(evento)){
		screenMdl.style.display = "none";
	}
}


screenMdl.addEventListener("click",function(event){
	gerenciaModal(event);		
});


modalBotaoOk.addEventListener("click", function(){
	window.location.href = "/user";	
})

