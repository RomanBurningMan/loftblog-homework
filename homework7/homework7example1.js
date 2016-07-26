module.export = timer;

function timer(time){
	var prom = new Promise((resolve, reject) => {
		setTimeout(resolve, time);
	});
	return prom;
}



