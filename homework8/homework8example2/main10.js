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
			let selectTr = inputBtn.parentNode.parentNode,
				selectTd = inputBtn.parentNode.parentNode.children,
				deleteCookie = confirm('Удалить cookie с именем - ' + selectTd[0].innerText);
			if (deleteCookie){
				let collectCookie = selectTd[0].innerText + '=' + selectTd[1].innerText,				
					date = new Date();
				
				date.setSeconds(date.getSeconds() - 1);
			
				let dateParse = date.toUTCString();
				document.cookie = collectCookie + '; expires=' + dateParse;
				container.removeChild(selectTr);
			}
		}
	})

}
getCookies();

function setCookies(){
	let introduceInput = document.getElementsByName('introduceCookies');
	
	numberField.addEventListener('keydown', e => {
		let keyCod = e.keyCode;
		if( keyCod > 57 && keyCod < 96){
			e.preventDefault();
		} 
	});

	addCookies.addEventListener('click', () => {
		let nameCookies = introduceInput[0].value,
			valueCookies = introduceInput[1].value,
			deadlinePeroid = introduceInput[2].value,
			date = new Date();
			
			date.setDate(date.getDate() + deadlinePeroid);
		let dateParse = date.toUTCString();
		
		document.cookie = `${nameCookies}=${valueCookies}; expires=${dateParse}`;
		
		console.log(nameCookies === "");
		if ( nameCookies === "" || valueCookies === "" || deadlinePeroid === ""){
			alert('Заполните все поля формы');
		} else {
			let tr = document.createElement('tr'),
				tdName = document.createElement('td'),
				tdValue = document.createElement('td'),
				tdBtn = document.createElement('td'),
				trAppend = container.appendChild(tr);

				tdName.innerHTML = nameCookies;
				tdValue.innerHTML = valueCookies;
				tdBtn.innerHTML = '<input type="button" name="btnCookie" value="Удалить">';

				trAppend.appendChild(tdName);
				trAppend.appendChild(tdValue);
				trAppend.appendChild(tdBtn);
		}		
	})
}
setCookies();



