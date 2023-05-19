
var idBtnBack = document.querySelector("#id-btn-back");
var deleteButton = document.querySelector('#delete-button');
/*user = getUser();*/


idBtnBack.addEventListener("click", function(){
	window.location.href = getMedformIndexUrl();
});


/*$(function(){

	$('#delete-button').submit(function(event){
		event.preventDefault();					// Prevenindo o comportamento padrao do botao submit

		alert('ggg');
	});
});*/

