let errors = [];

function displayErrors(){
    const err = document.getElementById('err');
    for(let i = 0; i < errors.length; i++){
        let errorNode = document.createTextNode(errors[i]);
        err.appendChild(errorNode);
        if(i !== errors.length - 1){
            let breakNode = document.createElement('br');
            err.appendChild(breakNode);
            err.appendChild(breakNode);
        }
    }
}
function clearErrors(){
    let err = document.getElementById('err');
    errors = [];
    err.innerText = '';
}
function valuesMatch(value1,value2){
    return value1 === value2;
}
function validateAlpha(value) {
    value = sanitize(value);
    const reg = /^[A-Za-z]+$/;
    return reg.test(value);
}
function validateAlphaNumeric(value){
    value = sanitize(value);
    const reg = /^[a-z0-9]+$/i;
    return reg.test(value);
}
function validateAlphaNumericSpaces(value){
    value = sanitize(value);
    const reg = /^[a-z\d\-_\s]+$/i;
    return reg.test(value);
}
function validateAnyInteger(value){
    value = sanitize(value);
    const reg = /^-?d+$/;
    return reg.test(value);
}
function validatePosInteger(value){
    value = sanitize(value);
    const reg = /^[0-9]*$/;
    return reg.test(value);
}
function validateDate(value){
    value = sanitize(value);
    const reg = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
    return reg.test(value);
}

