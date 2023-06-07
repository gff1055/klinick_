medFormArrayDisplay	= document.getElementsByClassName('infoMedForm');
previousBtnCol		= document.getElementsByClassName('previousBtnCol');
nextBtnCol			= document.getElementsByClassName('nextBtnCol');
statusMedForm 		= document.getElementsByClassName('status');
infoMedForm 		= document.getElementsByClassName('infoMedForm');
medFormInfoLink		= document.getElementsByClassName('medform-info-link');

beginPage	= document.getElementById('beginPage');
endPage		= document.getElementById('endPage');
allPages	= document.getElementById('allPages');


var showPage = 0;
var numberOfPages;


function setShowPageToMinimum(){	showPage = 0;	}
function setShowPageToMaximum(){	showPage = numberOfPages - 1;	}

function accessNextPage(pCurrentPage){		return pCurrentPage + 1;	}
function accessPreviousPage(pCurrentPage){	return pCurrentPage - 1;	}

function arriveOnPage(p1, p2){	return p1 == p2;	}

function isAnotherPageDisplayed(pPage, arrPaged){
	if(!arrPaged[pPage][0].classList.contains('noDisplay')) return true;
	else return false;
}

function isFirstPage(p){
	if(p == 0) return true;
	else return false;
}

function isLastPage(p, arrPaged){
	if(p == arrPaged.length - 1) return true;
	else return false;
}

function show(pRow){
	pRow.classList.remove('noDisplay');
	return pRow;
}

function hide(pRow){
	pRow.classList.add('noDisplay');
	return pRow;
}

function setToWaiting(pStatus){
	pStatus.classList.add('waiting');
	return pStatus;
}

function showStatus(pListStatus){
	for(i = 0; i<pListStatus.length; i++){

		if(pListStatus[i].innerHTML == "Esperando médico") setToWaiting(pListStatus[i]);
	}
}


/** Oculta os botoes */
function hideAllButtons(arrBtn){
	for(btn of arrBtn)
		btn.style.visibility = 'hidden';
	return btn;
}


/** Exibe os botoes */
function showAllButtons(arrBtn){
	for(btn of arrBtn)
		btn.style.visibility = 'visible';
	return btn;
}


/** Mostra informacoes da pagina */
function showInfoIndexPage(pPage, pArray){

	min = (pPage * 10) + 1;

	if(min + 9 > pArray.length)
		max = pArray.length;
	else
		max = min + 9;

	beginPage.innerHTML = min;
	endPage.innerHTML = max;
	allPages.innerHTML = pArray.length;
}


/** Esconde uma pagina na exibicao */
function hidePage(pPage, pArray){
	
	for(element of pArray[pPage])
		element = hide(element);

	return pArray;
}


/** Agrupa o array em 10 */
function groupArray(pArray){
	groupedArray = [];

	for(i = 0; i<pArray.length; i += 10)
		groupedArray[i/10] = pArray.slice(i, i+10);
	
	return groupedArray;
}


/** Exibe os dados de uma pagina */
function showRangeData(pShowPage, arrGroupPag){

	for(row = 0; row < arrGroupPag.length; row++)

		if(arriveOnPage(pShowPage, row)){
			for(medform = 0; medform < arrGroupPag[row].length; medform++) 
				arrGroupPag[row][medform] = show(arrGroupPag[row][medform]);
		}

		else if(isAnotherPageDisplayed(row, arrGroupPag)){
			arrGroupPag = hidePage(row, arrGroupPag);
		}

	return arrGroupPag;
}


/** Carrega e exibe os dados das paginas */
function loadPage(){
	
	if(showPage < 0) 				setShowPageToMinimum();
	if(showPage >= numberOfPages)	setShowPageToMaximum();

	/*beginPage.innerHTML = (showPage * 10) + 1;
	endPage.innerHTML = (showPage * 10) + 1 + 9;
	allPages.innerHTML = medFormArrayDisplay.length;*/

	showInfoIndexPage(showPage, medFormArrayDisplay);
	
	showButtons();
	
	pagedMedForms = showRangeData(showPage, pagedMedForms);
	showStatus(statusMedForm);
	window.scrollTo(0, 0);
}


/** Carrega e exibe os dados das paginas */
function loadLinks(pArray, pArrLinks){

	for(let element = 0; element < pArray.length; element++ ){
	
		pArray[element].addEventListener("click", function(){
			window.location.href = pArrLinks[element].href;		
		});
	}
}


window.addEventListener("load", function(){

	pagedMedForms = groupArray(Array.from(medFormArrayDisplay));
	numberOfPages = pagedMedForms.length;

	loadPage();
	loadLinks(infoMedForm, medFormInfoLink);
})


/** Eventos dos botoes anterior e proximo */
for(element = 0; element < nextBtnCol.length; element++ )
	nextBtnCol[element].addEventListener("click", function(){
		showPage = accessNextPage(showPage);
		loadPage();
	});


for(element = 0; element < previousBtnCol.length; element++ )
	previousBtnCol[element].addEventListener("click", function(){
		showPage = accessPreviousPage(showPage);
		loadPage();
	});


/*infoMedForm[0].addEventListener("click", function(){
	console.log('dssa');
});*/


function showButtons(){

	middlePage = true;

	if(isFirstPage(showPage)){
		hideAllButtons(previousBtnCol);
		showAllButtons(nextBtnCol);
		middlePage = false;
	}

	if(isLastPage(showPage, pagedMedForms)){
		showAllButtons(previousBtnCol);
		hideAllButtons(nextBtnCol);
		middlePage = false;
	}

	if(middlePage){
		showAllButtons(previousBtnCol);
		showAllButtons(nextBtnCol);
	}
	
}