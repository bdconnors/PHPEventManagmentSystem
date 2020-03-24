function validateLogin(){
    clearErrors();
    const validName = validateName();
    const validPass = validatePassword();
    const valid = validName && validPass;
    if(!valid){displayErrors(errors);}
    return valid;
}
function validateAccountCreation(){
    clearErrors();
    const validRole = validateRole();
    const validName = validateName();
    const nameConfirmed = confirmName();
    const validPass = validatePassword();
    const passConfirmed = confirmPassword();
    const valid = validRole && validName && nameConfirmed && validPass && passConfirmed;
    if(!valid){displayErrors(errors);}
    return valid;
}
function validateAccountUpdate(){
    clearErrors();
    const valid = validateUpdateFields();
    if(!valid){displayErrors();}
    return valid;
}
function validateRole(){
    const role = document.getElementById('role').value;
    const validRole = validatePosInteger(role);
    if(!validRole){errors.push('Invalid Role');}
    return validRole;
}
function validatePassword(){
    const password = document.getElementById('password').value;
    const validPassword = validateAlphaNumeric(password);
    if(!validPassword){errors.push('Invalid Password');}
    return validPassword;
}
function validateName(){
    const name = document.getElementById('name').value;
    const validName = validateAlphaNumeric(name);
    if(!validName){errors.push('Invalid account name');}
    return validName;
}
function confirmName(){
    const name = document.getElementById('name').value;
    const nameConfirm = document.getElementById('nameConfirm').value;
    const confirmed = valuesMatch(nameConfirm,name);
    if(!confirmed){errors.push('Account names do not match');}
    return confirmed;
}
function confirmPassword(){
    const password = document.getElementById('password').value;
    const passwordConfirm = document.getElementById('passwordConfirm').value;
    const match = valuesMatch(passwordConfirm,password);
    if(!match){errors.push('Passwords do not match');}
    return match;
}
function nameValidAndConfirmed(){
    const validName = validateName();
    const nameConfirmed = confirmName();
    return validName && nameConfirmed;
}
function passwordValidAndConfirmed(){
    const validPass = validatePassword();
    const passConfirmed = confirmPassword();
    return validPass && passConfirmed;
}
function validateUpdateFields(){
    let valid;
    const password = document.getElementById('password');
    const validName = nameValidAndConfirmed();
    const validRole = validateRole();
    if(!password.disabled) {
        const validPass = passwordValidAndConfirmed();
        valid = validRole && validName && validPass;
    }else{
        valid = validRole && validName;
    }
    return valid;
}