function setupUpdateSession(session){
    let obj = JSON.parse(session);
    const name = document.getElementById('name');
    const startDate = document.getElementById('startdate');
    const endDate = document.getElementById('enddate');
    const allowed = document.getElementById('numberallowed');
    name.value = obj.name;
    startDate.value = obj.dateStart;
    endDate.value = obj.dateEnd;
    allowed.value = obj.numberAllowed;
}