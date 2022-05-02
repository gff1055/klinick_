

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