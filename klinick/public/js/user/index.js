/*btnExitModalRegistrationForm = document.getElementById("btnExitModalRegistrationForm");
recordCreationForm = document.getElementById("recordCreationForm");*/

// fechar modal
$(":submit").on("click", function(){
	alert("Ficha de atendimento criada");
    $("#tokenCreationForm").modal('hide');
});


