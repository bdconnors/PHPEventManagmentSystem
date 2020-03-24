let newVenues = [];
let newSessions = [];
function reset(){
    newSessions = [];
    newVenues = [];
}
function newSession(name,numberallowed,startdate,enddate){
    newSessions.push({
        name:name,
        numberallowed:numberallowed,
        startdate:startdate,
        enddate:enddate
    });
}
function newVenue(name,capacity){
    newVenues.push({
        name:name,
        capacity:capacity
    });
}
function validateEventCreation(){
    clearErrors();
    const validName = nameValidAndConfirmed();
    const validDateRange = validateDateRange();
    const validVenue = validateVenue();
    const validManager = validateManager();
    const validNumberAllowed = validateNumberAllowed();
    const valid = validName && validDateRange && validVenue && validManager && validNumberAllowed;
    if(!valid){displayErrors();}
    return valid;
}
function validateDateRange(){
    const dateStart = document.getElementById('datestart').value;
    const dateEnd = document.getElementById('dateend').value;
    const validDateStart = validateDate(dateStart);
    const validDateEnd = validateDate(dateEnd);
    const validDateRange = validDateStart && validDateEnd;
    if(!validDateRange){errors.push('Invalid Date Range');}
    return validDateRange;
}
function validateManager(){
    const manager = document.getElementById('manager').value;
    const validManager = validateAnyInteger(manager);
    if(!validManager){errors.push('Invalid manager');}
    return validManager;
}
function validateVenue(){
    const venue = document.getElementById('venue').value;
    const validVenue = validateAnyInteger(venue);
    if(!validVenue){errors.push('Invalid venue');}
    return validVenue;
}
function validateNumberAllowed(){
    const numberAllowed = document.getElementById('numberallowed').value;
    const validNumberAllowed = validatePosInteger(numberAllowed);
    if(!validNumberAllowed){errors.push('Invalid number allowed');}
    return validNumberAllowed;
}
function validateName(){
    const name = document.getElementById('name').value;
    const validName = validateAlphaNumericSpaces(name);
    if(!validName){errors.push('Invalid event name');}
    return validName;
}
function confirmName(){
    const name = document.getElementById('name').value;
    const nameConfirm = document.getElementById('nameConfirm').value;
    const confirmed = valuesMatch(nameConfirm,name);
    if(!confirmed){errors.push('Event names do not match');}
    return confirmed;
}
function nameValidAndConfirmed(){
    const validName = validateName();
    const nameConfirmed = confirmName();
    return validName && nameConfirmed;
}