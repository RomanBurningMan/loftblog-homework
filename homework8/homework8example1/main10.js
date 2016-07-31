function getCookies(){
	let allCookie = document.cookie;
	let arrCookie = allCookie.split(';'),
		emptyArr = [];

	for (var i=0; i<arrCookie.length; i++){
		var nameValue = arrCookie[i].split('=');
		emptyArr[i] = { name: nameValue[0], value: nameValue[1] };
	}
	
	for (var prop of emptyArr){
		let tr = document.createElement('tr'),
			tdName = document.createElement('td'),
			tdValue = document.createElement('td'),
			tdBtn = document.createElement('td'),
			trAppend = container.appendChild(tr);

		tdName.innerHTML = prop.name;
		tdValue.innerHTML = prop.value;
		tdBtn.innerHTML = '<input type="button" name="btnCookie" value="Удалить">';

		trAppend.appendChild(tdName);
		trAppend.appendChild(tdValue);
		trAppend.appendChild(tdBtn);

	}

	container.addEventListener('click', e => {
		let inputBtn = e.target;
		if( inputBtn.tagName === 'INPUT' ){
			let selectTd = inputBtn.parentNode.parentNode.children,
				deleteCookie = confirm('Удалить cookie с именем - ' + selectTd[0].innerText);
			if (deleteCookie){
				let collectCookie = selectTd[0].innerText + '=' + selectTd[1].innerText,				
					date = new Date();
				
				date.setSeconds(date.getSeconds() - 1);
			
				let dateParse = date.toUTCString();
				document.cookie = collectCookie + '; expires=' + dateParse;  
			}
		}
	})

}

getCookies();

