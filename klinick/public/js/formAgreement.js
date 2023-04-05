
btnContinue = document.getElementById("btnContinueAgreement");
checkBoxAccept = document.getElementById("checkBoxAgreement");

function userAcceptedTerms(checkBox){
	return checkBox.checked;
}



btnContinue.addEventListener("click", function(){
	if(userAcceptedTerms(checkBoxAccept))
		window.location.href = "/doctor/create";
	else
		alert("É preciso ler o consentimento legal e marcar que aceita os termos");
});