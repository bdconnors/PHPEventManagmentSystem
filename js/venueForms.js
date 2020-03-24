function validateVenueCreation(){
    clearErrors();
    const validName = nameValidAndConfirmed();
    const validCapacity = validateCapacity();
    const valid = validName && validCapacity;
    if(!valid){displayErrors(errors);}
    return valid;
}
function validateVenueUpdate(){
    clearErrors();
    const validName = validateName();
    const validCapacity = validateCapacity();
    const valid = validName && validCapacity;
    if(!valid){displayErrors(errors);}
    return valid;

}
function validateCapacity(){
    const capacity = document.getElementById('capacity').value;
    const validCapacity = validatePosInteger(capacity);
    if(!validCapacity){errors.push('Invalid capacity');}
    return validCapacity;
}
function validateName(){
    const name = document.getElementById('name').value;
    const validName = validateAlphaNumericSpaces(name);
    if(!validName){errors.push('Invalid venue name');}
    return validName;
}
function confirmName(){
    const name = document.getElementById('name').value;
    const nameConfirm = document.getElementById('nameConfirm').value;
    const confirmed = valuesMatch(nameConfirm,name);
    if(!confirmed){errors.push('Venue names do not match');}
    return confirmed;
}
function nameValidAndConfirmed(){
    const validName = validateName();
    const nameConfirmed = confirmName();
    return validName && nameConfirmed;
}