function calculator(numb){
	this.numbFirst = numb;
}

calculator.prototype.sum = function(){
  var sumArg = this.numbFirst;
  for (var i=0; i < arguments.length; i++){
    sumArg += arguments[i];
  }
  return sumArg;
}

calculator.prototype.dif = function(){
  var difArg = this.numbFirst;
  for (var i=0; i < arguments.length; i++){
    difArg -= arguments[i];
  }
  return difArg;    
}

calculator.prototype.div = function(){
  var divArg = this.numbFirst;
  for (var i=0; i < arguments.length; i++){
    if (arguments[i] === 0){
      throw new Error('На ноль делить нельзя');
    } else {
      divArg /= arguments[i];
    }
  }
  return divArg;    
}

calculator.prototype.mul = function(){
  var mulArg = this.numbFirst;
  for (var i=0; i < arguments.length; i++){
    mulArg *= arguments[i];
  }
  return mulArg;   
}

function Sqrt(numb) {
  calculator.call(this, numb);
}

Sqrt.prototype = Object.create(calculator.prototype);

Sqrt.prototype.sum = function(){
  var result = calculator.prototype.sum.apply(this, arguments);
  return result * result;
};

Sqrt.prototype.dif = function(){
  var result = calculator.prototype.dif.apply(this, arguments);
  return result * result;
};

Sqrt.prototype.div = function(){
  var result = calculator.prototype.div.apply(this, arguments);
  return result * result;
};

Sqrt.prototype.mul = function(){
  var result = calculator.prototype.mul.apply(this, arguments);
  return result * result;
};

var myCalculator = new Sqrt(100);

console.log(myCalculator.sum(1,2,3));
console.log(myCalculator.dif(1,2,3));
console.log(myCalculator.div(1,2,3));
console.log(myCalculator.mul(1,2,3));

module.export = myCalculator;

