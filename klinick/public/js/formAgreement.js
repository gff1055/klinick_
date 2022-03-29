
btnContinue = document.getElementById("btnContinueAgreement");
checkBoxAccept = document.getElementById("checkBoxAgreement");

function UserAcceptedTerms(checkBox){return checkBox.checked;}



btnContinue.addEventListener("click", function(){
	if(UserAcceptedTerms(checkBoxAccept))
		window.location.href = "/doctor/create";
	else
		alert("É preciso ler o consentimento legal e marcar que aceita os termos");
});