
modalBotaoOk = document.getElementsByClassName("buttonOk")[0];
modal = document.getElementsByClassName("mdl")[0];
screenMdl = document.getElementsByClassName("screenMdl")[0];


modalBotaoOk.addEventListener("click",function(event){
	modal.style.display = "none";
	screenMdl.style.display = "none";
	window.location.href = "/doctor/agreement";	
});