function setAccountRole(id){
    let roles = document.getElementById('role');
    for(let i = 0; i < roles.options.length; i++){
        let option = roles.options[i];
        if(option.value === id){
            option.selected = true;
        }
    }
}
function setupUpdateAccount(account){
    const acc = JSON.parse(account);
    const roleBtn = document.getElementById('editRoleBtn');
    roleBtn.addEventListener('click',toggleUpdateRole);
    const nameBtn = document.getElementById('editNameBtn');
    nameBtn.addEventListener('click',toggleUpdateName);
    const passBtn = document.getElementById('editPassBtn');
    passBtn.addEventListener('click',toggleUpdatePassword);
    setAccountRole(acc.role.id);
}
function updateButton(btn,enable){
    if(enable) {
        btn.name = 'cancel';
        btn.innerText = '';
        btn.innerText = 'Cancel';
    }else{
        btn.name = 'edit';
        btn.innerText = '';
        btn.innerText = 'Edit';
    }
}
function toggleUpdateRole(e){
    const btn = e.target;
    const enable = btn.name === 'edit';
    const input = document.getElementById('role');
    updateButton(btn,enable);
    input.disabled = !enable;
}
function toggleUpdateName(e){
    const btn = e.target;
    const enable = btn.name === 'edit';
    const input = document.getElementById('name');
    updateButton(btn,enable);
    input.disabled = !enable;
}
function toggleUpdatePassword(e){
    let container = document.getElementById('passwordConfirmContainer');
    let passInput = document.getElementById('password');
    let confirmInput = document.getElementById('passwordConfirm');
    let btn = e.target;
    let enable = btn.name === 'edit';
    updateButton(btn,enable);
    if(enable){
        container.style.display = '';
        passInput.value = '';
        passInput.disabled = false;
        confirmInput.disabled = false;
    }else{
        container.style.display = 'none';
        passInput.value = 'dummypassword';
        passInput.disabled = true;
        confirmInput.disabled = true;
    }
}
function hidePasswordUpdate(){
    let updateInput = document.getElementById('updatePassInput');
    let pass = document.getElementById('password');
    let confirmPass = document.getElementById('passwordConfirm');
    let updateBtn = document.getElementById('updatePassBtn');
    let cancelBtn = document.getElementById('cancelUpdateBtn');
    cancelBtn.style.display = 'none';
    updateInput.style.display = 'none';
    pass.disabled = true;
    confirmPass.disabled = true;
    updateBtn.style.display ='';
}
function validateLogin(){
    clearErrors();
    const validName = validateName();
    const validPass = validatePassword();
    const passConfirmed = confirmPassword();
    const valid = validName && validPass && passConfirmed;
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