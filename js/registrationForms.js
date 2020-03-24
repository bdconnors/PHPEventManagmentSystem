function setupUpdateRegistration(registration){
    let obj = JSON.parse(registration);
    const session = document.getElementById('session');
    const paid = document.getElementById('paid');
    for(let i = 0; i < session.options.length; i++){
        let option = session.options[i];
        if(option.value === obj.session.id){
            option.selected = true;
        }
    }
    console.log(obj.paid);
    paid.checked = obj.paid !== 1;
}