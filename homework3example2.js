function isSomeTrue(source, filterFn) {
	var numb;
	if (source[0] === undefined) {
		throw new Error('Массив совсем пустой!(((');
	} else {
		for (var i=0; i<source.length; i++){
			numb = source[i];
			if (filterFn(numb) === true) {
				return true;
			}
		}
		if (filterFn(numb) === false){
			return false;
		}
	}
};

var allNumbers = [1, 2, 4, 5, 6, 7, 8],
	someNumbers = [1, 2, 'привет', 4, 5, 'loftschool', 6, 7, 8],
	noNumbers = ['это', 'массив', 'без', 'чисел'],
	emptyArr = [];

function isNumber(val) {
	return typeof val === 'number';
};

console.log(isSomeTrue(allNumbers, isNumber)); 
console.log(isSomeTrue(someNumbers, isNumber));
console.log(isSomeTrue(noNumbers, isNumber));
console.log(isSomeTrue(emptyArr, isNumber));

module.exports = isSomeTrue;
