var btnColor = document.getElementById('btn'),
	divContainer = document.getElementById('box'),
	activeElem,
	offsetX = 0,
	offsetY = 0;

var changeColor = function(e){
	divContainer.style.display = "block";
	var a1 = Math.random() * 256,
		b1 = Math.random() * 256,
		c1 = Math.random() * 256;

	var r = a1.toFixed(0);
		g = b1.toFixed(0);
		b = c1.toFixed(0);

	divContainer.style.backgroundColor =  `rgb(${r},${g},${b})`;
}

var mDown = function(e){
	activeElem = e.target;
	offsetX = e.offsetX;
	offsetY = e.offsetY;
}

var mUp = function(e){
	activeElem = null;
}

var mMove = function(e){
	activeElem.style.top = (e.clientY - offsetY) + 'px';
	activeElem.style.left = (e.clientX - offsetX) + 'px';
}

btnColor.addEventListener('click', changeColor);
document.addEventListener('mousemove', mMove);
divContainer.addEventListener('mouseup', mUp);
divContainer.addEventListener('mousedown', mDown);


 