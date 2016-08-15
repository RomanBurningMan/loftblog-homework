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

ajax(url1).then((response) => {
	
	let source = templateList.innerHTML,
		templateFn = Handlebars.compile(source),
		template = templateFn({ list: response });
	result.innerHTML = template;
	
	let	listCity = result.children[0].children;
	
	searchCity.addEventListener('keyup', () => {
		for(let propLi of listCity){
			let	innerLiText = propLi.innerText.toLowerCase(),
				inputValue = searchCity.value.toLowerCase(),
				indexCity = innerLiText.indexOf(inputValue);
			if (indexCity < 0){
				propLi.style.display = 'none';
			} else {
				propLi.style.display = 'block';
			}
		}		
	});

}, () => {new Error('Не пришел ответ с сервера!')});