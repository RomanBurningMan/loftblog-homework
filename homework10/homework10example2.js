class calculator {
  constructor(numb){
    this.numbFirst = numb;
  }

  sum() {
    var sumArg = this.numbFirst;
    for (var i=0; i < arguments.length; i++){
      sumArg += arguments[i];
    }
    return sumArg;
  }

  dif() {
    var difArg = this.numbFirst;
    for (var i=0; i < arguments.length; i++){
      difArg -= arguments[i];
    }
    return difArg;    
  }

  div() {
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

  mul() {
    var mulArg = this.numbFirst;
    for (var i=0; i < arguments.length; i++){
      mulArg *= arguments[i];
    }
    return mulArg;   
  }
}

class Sqrt extends calculator {
  constructor(numb){
    super(numb);
  }

  sum() {
    var elem = super.sum(...arguments);
    return elem * elem;
  }

  dif() {
    var elem = super.dif(...arguments);
    return elem * elem;
  }

  div() {
    var elem = super.div(...arguments);
    return elem * elem;
  }

  mul() {
    var elem = super.mul(...arguments);
    return elem * elem;
  }
}

var myCalculator = new Sqrt(100);

module.export = myCalculator;



