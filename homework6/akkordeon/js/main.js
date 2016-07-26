var links = document.getElementsByClassName('arrows'),
	mainBlock = document.getElementsByClassName('main-item'),
	akkordBlock = document.getElementById('akkord');

var func1 = function (e){
	var link = e.target,
		classLink = link.getAttribute('class'),
		parent = e.target.parentNode,
		allSubMenu = document.getElementsByClassName('sub-menu'),
		subMenu = parent.getElementsByClassName('sub-menu'),
		style = subMenu[0].style;

	// links.classList.remove('active');
	for (var prop1 of allSubMenu){
		prop1.style.display = "none";
	}

	for (var prop2 of links){
		prop2.classList.remove('active');
	}

	link.classList.add('active');
	style.display = "block";

		
}

akkordBlock.addEventListener('click', func1);


