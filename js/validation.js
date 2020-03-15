function validateLogin(){
    let submit;
    const err = document.getElementById('err');
    err.innerText = '';
    const name = document.getElementById('name').value;
    const password = document.getElementById('password').value;
    const validName = validateAlphaNumeric(name);
    const validPass = validateAlphaNumeric(password);
    if(!validName || !validPass){
        err.innerText = 'Invalid user name or password';
        submit = false;
    }else{
        submit = true;
    }
    return submit;
}
function validateRegistration(){
    let submit = false;
    const err = document.getElementById('err');
    err.innerText = '';
    const name = document.getElementById('name').value;
    const nameConfirm = document.getElementById('nameConfirm').value;
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('passwordConfirm').value;
    const namesMatch = name === nameConfirm;
    const passwordsMatch = password === passwordConfirm;
    const validName = validateAlphaNumeric(name);
    const validPassword = validateAlphaNumeric(password);
    if(!namesMatch){
        err.innerText = 'User names do not match';
        submit = false;
    }else if(!passwordsMatch){
        err.innerText = 'Passwords do not match';
        submit = false;
    }else if(!validName){
        err.innerText = 'Invalid User Name';
        submit = false;
    }else if(!validPassword){
        err.innerText = 'Invalid Password';
        submit = false;
    }else{
        submit = true;
    }
    console.log(submit);
    return submit;
}
function validateAlphaNumeric(value){
    let valid = true;
    const reg = /^[a-z0-9]+$/i;
    let validAlphaNumeric = reg.test(value);
    let isAttack = attackAttempted(value);
    if(!validAlphaNumeric || isAttack){
        valid = false;
    }
    return valid;

}
function validateAlpha(value) {
    let valid = true;
    value = sanitize(value);
    const reg = /^[A-Za-z]+$/;
    let validAlpha = reg.test(value);
    let isAttack = attackAttempted(value);
    if(!validAlpha || isAttack){
        valid = false;
    }
    return valid;
}
function validateNumber(value){
    let valid = true;
    value = sanitize(value);
    const reg = /^[0-9]*$/;
    let validNumber = reg.test(value);
    let isAttack = attackAttempted(value);
    if(!validNumber|| isAttack){
        valid = false;
    }
    return valid;
}
function validateDate(value){
    let valid = true;
    value = sanitize(value);
    const reg = /([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
    let validDate = reg.test(value);
    let isAttack = attackAttempted(value);
    if(!valid || !validDate|| isAttack){
        valid = false;
    }
    return valid;
}
function attackAttempted(value){
    let isAttack = false;
    let scriptAttack = scriptingAttempted(value);
    let injectionAttack = injectionAttempted(value);
    if(scriptAttack|| injectionAttack){
        isAttack = true;
    }
    return isAttack;
}
function injectionAttempted(value){
    let attempted = false;
    let meta = sqlMetaChars(value);
    let inject = sqlInjection(value);
    let union = sqlInjectionUnion(value);
    let select = sqlInjectionSelect(value);
    let del = sqlInjectionDelete(value);
    let drop = sqlInjectionDrop(value);
    let insert = sqlInjectionInsert(value);
    let update = sqlInjectionUpdate(value);
    if(meta|| inject|| union || select|| del || drop|| insert || update){
        attempted = true;
    }
    return attempted;
}
function scriptingAttempted(value){
    let attempted = false;
    let crossSiteScript = crossSite(value);
    let crossSiteImgScript = crossSiteImg(value);
    let crossSiteExtraScript = crossSiteAdditional(value);
    if(crossSiteScript || crossSiteImgScript|| crossSiteExtraScript){
        attempted = true;
    }
    return attempted;
}
function sqlMetaChars(value) {
    const reg = /((\%3D)|(=))[^\n]*((\%27)|(\')|(\-\-)|(\%3B)|(;))/i;
    return reg.test(value);
}
function sqlInjection(value) {
    const reg = /\w*((\%27)|(\'))((\%6F)|o|(\%4F))((\%72)|r|(\%52))/i;
    return reg.test(value);
}
function sqlInjectionUnion(value) {
    const reg = /((\%27)|(\'))union/i;
    return reg.test(value);
}
function sqlInjectionSelect(value) {
    const reg = /((\%27)|(\'));\s*select/i;
    return reg.test(value);
}
function sqlInjectionInsert(value) {
    const reg = /((\%27)|(\'));\s*insert/i;
    return reg.test(value);
}
 function sqlInjectionDelete(value) {
     const reg = /((\%27)|(\'));\s*delete/i;
     return reg.test(value);
}
function sqlInjectionDrop(value) {
    const reg = /((\%27)|(\'));\s*drop/i;
    return reg.test(value);
}
function sqlInjectionUpdate(value) {
    const reg = /((\%27)|(\'));\s*update/i;
    return reg.test(value);
}
function crossSite(value) {
    const reg = /((\%3C)|<)((\%2F)|\/)*[a-z0-9\%]+((\%3E)|>)/i;
    return reg.test(value);
}
function crossSiteImg(value) {
    const reg = /((\%3C)|<)((\%69)|i|(\%49))((\%6D)|m|(\%4D))((\%67)|g|(\%47))[^\n]+((\%3E)|>)/i;
    return reg.test(value);
}
function crossSiteAdditional(value) {
    const reg = /((\%3C)|<)[^\n]+((\%3E)|>)/i;
    return reg.test(value);
}