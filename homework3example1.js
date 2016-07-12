function isAllTrue(source, filterFn) {
	if (source[0] === undefined) {
		throw new Error('Массив совсем пустой!(((');
	} else {
		for (var i=0; i<source.length; i++){
			var numb = source[i];
			if (filterFn(numb) === false) {
				return false;
			}
		}
		if (filterFn(numb) === true){
			return true;
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

console.log(isAllTrue(allNumbers, isNumber)); 
console.log(isAllTrue(someNumbers, isNumber));
console.log(isAllTrue(noNumbers, isNumber));
console.log(isAllTrue(emptyArr, isNumber));

module.exports = isAllTrue;