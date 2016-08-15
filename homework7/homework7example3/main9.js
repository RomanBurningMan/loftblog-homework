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
	for (let obj of text) {
		let newLi = document.createElement('li'),
			nameCity = obj.name;
			
		newLi.innerText = nameCity;
		newLi.style.display = 'none';
		result.appendChild(newLi);
	}

	searchField.addEventListener('keyup', () => {
		let valueInput = searchField.value.toLowerCase(),
			elemItem = result.children;

		for (var elem of elemItem){
			let textItem = elem.innerText.toLowerCase(),
				indexItem = textItem.indexOf(valueInput);
			
			if ( indexItem < 0 ){
				elem.style.display = 'none';
			} else {
				elem.style.display = 'block';
			}
		}

	})
}, () => {new Error('Не пришел ответ с сервера!')});