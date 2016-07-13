function calculator(firstNumber){
	var calc = {
		sum: function(){
          var sumArg = firstNumber;
          for (var i=0; i < arguments.length; i++){
            sumArg += arguments[i];
          }
          return sumArg;
		},
        dif: function(){
          var difArg = firstNumber;
          for (var i=0; i < arguments.length; i++){
            difArg -= arguments[i];
            }
          return difArg;    
        },
        div: function(){
          var divArg = firstNumber;
          for (var i=0; i < arguments.length; i++){
            if (arguments[i] === 0){
              throw new Error('На ноль делить нельзя');
            } else {
              divArg *= arguments[i];
            }
          }
          return divArg;    
        },
        mul: function(){
          var mulArg = firstNumber;
          for (var i=0; i < arguments.length; i++){
            mulArg *= arguments[i];
          }
          return mulArg;    
        }
	};	
	return calc;
}
var myCalculator = calculator(100);
console.log(myCalculator.sum(1, 2, 3)); //вернет 106
console.log(myCalculator.dif(10, 20)); //вернет 70
console.log(myCalculator.div(2, 2)); //вернет 25
console.log(myCalculator.mul(2, 2)); //вернет 400

module.export = calculator;
