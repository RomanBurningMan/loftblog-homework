module.export = {prepend: prepend,
				deleteTextNodes: deleteTextNodes};

// ДЗ - 1

function prepend (container, newElem){
	var firstCh = container.firstElementChild;
		container.insertBefore(newElem, firstCh);
	return 'Функция отработала';	
}

// ДЗ - 2

function deleteTextNodes(parentElem){
	var i,
		elemArr = parentElem.childNodes;
	for (i=0; i<elemArr.length; i++){
		itemArr = parentElem.childNodes[i];
		if (itemArr.nodeType === 3){
			parentElem.removeChild(elemArr[i]);
		}
	}
	return elemArr;
}








