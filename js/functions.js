/**
 * 
 */

function goRight(className, total){
	var itens = document.getElementsByClassName(className);
	var count = 0;
	var last = itens.length - 1;
	if((itens.item(last).style.display) == 'block'){
		return 0;
	}
	while (count < itens.length){
		if (itens.item(count).style.display == 'block'){
			itens.item(count).style.display = 'none';
			count = count + total;
			itens.item(count).style.display = 'block';
		}
		count++;		
	}
} 

function goLeft(className, total){
	var itens = document.getElementsByClassName(className);
	var count = itens.length - 1;
	if((itens.item(0).style.display) == 'block'){
		return 0;
	}
	while (count >= 0){
		if (itens.item(count).style.display == 'block'){
			itens.item(count).style.display = 'none';
			count = count - total;
			itens.item(count).style.display = 'block';
		}
		count--;		
	}
} 


function abrirImagemGaleria(elementID){
	/*silence is gold*/
} 

 function goPaginate(divClass, pageNum){
	var getPag = divClass + 'Pag';
	var formName = divClass + '_form';
	var inputControl = document.getElementById(getPag);
	inputControl.value = pageNum;
	document.forms[formName].submit();
}

function showhide(id){
	var map = document.getElementById(id);
	if (map == null){
		return null;
	}
	if (map.style.display == 'block'){
		map.style.display = 'none';
	} else {
		map.style.display = 'block';
	}	
}

function showhide_produto(id){
	var comId = 'conteudo_'+id;
	var map = document.getElementById(comId);
	if (map.style.display == 'block'){
		map.style.display = 'none';
	} else {
		map.style.display = 'block';
		map.scrollIntoView(true);
	}	
}

function showFooterSubmenu(){
	document.getElementById('footer-sub-menu').style.display = 'block';
}

function hideFooterSubmenu(){
	document.getElementById('footer-sub-menu').style.display = 'none';
}

function abrirImagemGaleria(idImage){
	var viewer = document.getElementById('sort-image');
	var newImage = document.getElementById(idImage);
	viewer.src = newImage.src;
}

function submitForm(){
	document.forms['search-form'].submit();
}

function addSubmitBuscaImovel(){
	var campoTipo = document.getElementById('imovel-tipo');
	var campoCidade = document.getElementById('imovel-cidade');
	var campoTexto = document.getElementById('imovel-texto');
	campoTipo.onchange = function(){document.forms['search-form'].submit();};
	campoCidade.onchange = function(){document.forms['search-form'].submit();};
	campoTexto.onchange = function(){document.forms['search-form'].submit();};
}

function selectedValue(campoId, valor){
	document.getElementById(campoId).value = valor;
}

function limparFiltroImoveis(){
	selectedValue('imovel-tipo', 0);
	selectedValue('imovel-cidade', '');
	selectedValue('imovel-texto', '');
	document.forms['search-form'].submit();
}

