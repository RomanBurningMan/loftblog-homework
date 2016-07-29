let url1 = 'https://raw.githubusercontent.com/smelukov/citiesTest/master/cities.json';

function ajax(url){
	
	return new Promise((resolve, reject) => {
		let xhr = new XMLHttpRequest();
		xhr.open('GET', url);
		xhr.responseType = 'json';
		xhr.addEventListener('load', () => {
			resolve(xhr.response);
		});
		xhr.addEventListener('error', () => {
			reject();
		});
		xhr.send();
	});
}

ajax(url1).then((text) => {
	var parentDiv = document.getElementById('container'),
		childDiv = parentDiv.getElementsByTagName('div');
	
	searchField.addEventListener('keydown', () => {
		for ( iter of childDiv ){
			parentDiv.removeChild(iter);	
		}
	});
	
	searchField.addEventListener('keyup', () => {
		var emptyArr = [],
			innerText = searchField.value;
		for( {name} of text ){
			let index = name.indexOf(innerText);
			if (index > 0){
				emptyArr.push(name);	
			}
		}
		
		for ( itemArr of emptyArr){
			var	newDiv = document.createElement('div');
			newDiv.innerText = itemArr;
			parentDiv.appendChild(newDiv);	
		}
		
		
	});
}, () => {console.log('Error)')});