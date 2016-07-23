module.export = {deleteTextNodes1: deleteTextNodes1,
				scanDom: scanDom,
				count: count};
// ДЗ - 3

var i = 0;
function deleteTextNodes1(parentsElem){
	var elemArr = parentsElem.childNodes,
		itemArr = parentsElem.childNodes[i];
	if ( i<elemArr.length){
		var typeItem = itemArr.nodeType;
		if ( typeItem === 3){
			parentsElem.removeChild(itemArr);
		} else  if ( elemArr[i].tagName === 'DIV'){
			i = 0;
			deleteTextNodes1(itemArr);
		}	
		i += 1;
		deleteTextNodes1(parentsElem);
	} 
};

// ДЗ - 4
var emptyObj = {}, // нужно передать аргументом в функцию count()
	parentsElem = document.getElementsByTagName('body'),
	bodyElem = parentsElem[0]; // нужно передать в качестве аргумента в функцию scanDom()
	
function scanDom(itemNode){
	var nodesArr = itemNode.children;
	for ( var prop of nodesArr){
		var varName = prop.tagName,
			childNode = prop.children;
		// идентификация элемента	
		if(emptyObj.hasOwnProperty(varName)){
			emptyObj[varName] += 1;
		} else {
			emptyObj[varName] = 1;
		}	
		// идентификация атрибута class
		if (prop.hasAttribute('class')){
			var attrClass = prop.getAttribute('class');
			if(emptyObj.hasOwnProperty(attrClass)){
				emptyObj[attrClass] += 1;
			} else {
				emptyObj[attrClass] = 1;
			}			
		}	
		// запуск рекурсии, если элемент содержит вложениые элементы
		if ( childNode[0] !== undefined ){
			scanDom(prop);
		}
	}
};
// функция для вывода значений
function count(e){
	for(var prop in e){
		console.log('Это элемент "' + prop + '" - ' + e[prop]);
	}
}