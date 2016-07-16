module.export = deepEqual;
function deepEqual(a, b){
    var obj1 = a,
        obj2 = b,
        i = 0,
        i2 = 0;
    function nameKeys(iter1, iter2){
        var objKey1 = Object.keys(iter1),
            objKey2 = Object.keys(iter2);
        if ( objKey1.length == objKey2.length ){
            if (i2 < objKey1.length){
                var key1 = objKey1[i],
                    key2 = objKey2[i2];
                if ( key1 !== key2 ){
                    i2++;
                    nameKeys(iter1, iter2);
                } else {
                    var attr1 = iter1[key1],
                        attr2 = iter2[key2];
                    i++;
                    i2 = 0;
                    if ( typeof attr1 === 'object'){
                        if ( attr1 instanceof Date){
                        var year1 = attr1.getFullYear(),
                            year2 = attr2.getFullYear(), 
                            month1 = attr1.getMonth(),
                            month2 = attr2.getMonth(),
                            date1 = attr1.getDate(),
                            date2 = attr2.getDate();
                            if (year1 === year2 && month1 === month2 && date1 === date2){
                                nameKeys(obj1, obj2);
                            } else{ 
                                throw new Error('Объекты не равны!!!');
                            }
                        } else {
                            deepEqual(attr1, attr2);
                        } 
                    }
                    if ( typeof attr1 === 'string' || typeof attr1 === 'number') {                    
                        if ( attr1 === attr2 ){
                            nameKeys(obj1, obj2);
                        } else {
                            throw new Error('Объекты не равны!!!');
                        }  
                    }

                }
            }
        } else { 
            throw new Error('Объекты не равны!!!');
        }
    }
    nameKeys(obj1, obj2);
    return 'Объекты равны';
} 
console.log(deepEqual(objA, objB));
