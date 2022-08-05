modalBotaoOk = document.getElementsByClassName("buttonOk")[0];
modal = document.getElementsByClassName("modal")[0];
//screenMdl = document.getElementsByClassName("screenMdl")[0];


modalBotaoOk.addEventListener("click",function(event){
	/*modalBackDrop = document.getElementsByClassName("modal-backdrop");
	if(modalBackDrop[0].parentNode){
		modalBackDrop[0].parentNode.removeChild(modalBackDrop[0]);
	}*/
	/*modal.style.display = "none";*/
	window.location.href = "/doctor";
});