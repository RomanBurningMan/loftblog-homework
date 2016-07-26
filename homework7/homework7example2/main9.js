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
	var emptyArr = [], 
		sortArr,
		parentDiv = document.getElementById('container');

	for( {name} of text ){
		emptyArr.push(name);
	}
	sortArr = emptyArr.sort();	
	
	for (let i = 0; i < sortArr.length; i++) {
		var count = i + 1,
			newDiv = document.createElement('div');
		newDiv.innerText = count + ' - ' + sortArr[i];
		parentDiv.appendChild(newDiv);
	}
}, () => {console.log('Error)')});