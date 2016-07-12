var i = 0;
function consoleRec(arr){
		
	if (i < arr1.length){
		console.log(arr1[i]);
		i += 1; 
		func1(arr);
	}
};
var arr1 = ['Я','умею','писать','рекурсивные','функции'];
consoleRec(arr1);

module.export = consoleRec;
