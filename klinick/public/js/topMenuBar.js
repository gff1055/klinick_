

inputMenuSandwich = document.getElementById("inputMenuSandwich");		// referencia do checkbox para fechar abrir o menu
body = document.getElementsByTagName("body")[0];						// referencia do body do documento
menuToggle = document.getElementById("menuToggle");						// referencia do menu
menu = document.getElementById("menu");
buttonExitUser = document.getElementsByClassName("buttonExitUser")[0];
flagCloseMenuBar = false;												// flag que indica se o menu esta aberto ou nao




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
