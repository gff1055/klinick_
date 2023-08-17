
var idBtnBack = document.querySelector("#id-btn-back");

idBtnBack.addEventListener("click", function(){
	alert("a");
	window.location.href = getLoadAppointmentsUrl();
});