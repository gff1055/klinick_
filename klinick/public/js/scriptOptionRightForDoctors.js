//optionBeDoctor = document.querySelector("#topMenuBarOptionRight .btn");

modalBotaoOk = document.getElementsByClassName("buttonOk")[0];


modalBotaoOk.addEventListener("click",function(event){
	modal.style.display = "none";
	screenMdl.style.display = "none";
	window.location.href = "/user";	
});

