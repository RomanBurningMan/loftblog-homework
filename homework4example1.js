var array = [1, 2, 3, 4, 5, 6, 7, 8, 9];

// map //

function map1(arr, callback){
  	var itemFunc, i, newArr = [];
    for( i=0; i < arr.length; i++){
  		itemFunc = arr[i];
    	if (i in arr){
      		newArr[newArr.length] = callback(itemFunc, i);
    	} 
	}
	return newArr;  
}
// callback-function
function sum(item, i){
  return item.length;
}
// console.log(map1(array, sum));

// filter //

function filter1(arr, callback){
	let i, newArr = [];
	for( i=0; i < arr.length; i++){
		let funcFilt = callback(arr[i]);
		if (i in arr){
			if ( funcFilt === true) {
      			newArr[newArr.length] = arr[i];	
      		}
      	}
	}
	return newArr;
}
// callback-function
function filt(item){
	return item > 3;
}
// console.log(filter1(array, filt));

// forEach //

function forEach1(arr, callback){
  	var itemFunc, i, newArr = [];
    for( i=0; i < arr.length; i++){
  		itemFunc = arr[i];
    	if (i in arr){
      		arr[i] = callback(itemFunc, i);
    	} 
	}
	return arr;  
}
// callback-function
function sum(item, i){
  return item*8;
}
// console.log(forEach1(array, sum));

// slice //

function slice1(a, b, arr){
	let i, 
		argArr, 
		newArr = [];
	for( i=0; i<arr.length; i++){
		argArr = arr[i];
		if(i in arr){
			if ( a < 0 || b < 0 ){
				if ( a < 0){
					a = arr.length + a;
				}	
				if ( b < 0){
					b = arr.length + b;
				}
				if (i >= a && i < b) {
					newArr[newArr.length] = argArr;		
				}
			} else {
				if ( i >= a && i < b){
					newArr[newArr.length] = argArr;
				}
			}
		}
	}
	return newArr;
}
// console.log(slice1( 1, -2, array));

// reduce //

var array = [1, 2, 3, 4, 5];
function reduce1(arr, callback, initValue){
	var sum = initValue, current, i;
	if(arguments.length === 3){
		sum = callback(sum, arr[0]);
		for( i=1; i<arr.length; i++){
			var sum = callback(sum, arr[i]);
		}	
	} else if(arguments.length === 2){
		sum = arr[0];
		for( i=1; i<arr.length; i++){
			var sum = callback(sum, arr[i]);
		}	
	} 
	return sum;
}
function result(sum, current){
	return sum + current;
}
console.log(reduce1(array, result));


module.export = {
	forEach1: forEach1,
	map1: map1,
	filter1: filter1,
	slice1: slice1,
	reduce1: reduce1
};
