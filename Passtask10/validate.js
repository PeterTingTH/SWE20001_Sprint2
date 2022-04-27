const Name = document.getElementById('name');
const phonenumber = document.getElementById('phone number');
const state = document.getElementById('state');
const postcode = document.getElementById('postcode');
const address = document.getElementById('address');
const time = document.getElementById('time');

Form.addEventListener('submit', (e) => {
     var isAllOk;
     isAllOk = checkInputs();

     if(!isAllOk){
         e.preventDefault();
     }else {
         if(typeof(Storage) !== "undefined"){
             localStorage.setitem("name", Name.value);
             localStorage.setitem("phone number", phonenumber.value);
             localStorage.setitem("state", state.value);
             localStorage.setitem("postcode", postcode.value);
             localStorage.setitem("address", address.value);
             localStorage.setitem("time", time.value);
         }else{
             alert("Sorry, your browser does not support Web Storage.");
         }
     }
});

function checkInputs(){
    const NameValue = Name.value.trim();
    const phonenumberValue = phonenumber.value.trim();
    const stateValue = state.value.trim();
    const postcodeValue = postcode.value.trim();
    const addressValue = address.value.trim();
    const timeValue = time.value.trim();

    var isAllOk = false;
    var NameOk;
    var phonenumberOk;
    var stateOk;
    var postcodeOk;
    var addressOk;
    var timeOk;
    var namePattern = /^[a-zA-Z]+$/;
    var phonePattern = /^[0-9]+$/;
    var postcodePattern = /^[0-9]{5}$/;

    if(NameValue === ''){
        setErrorFor(Name, 'Name cannot be blank');
        NameOk = false;
    }else {
        if(!namePattern.test(NameValue)){
            setErrorFor(Name, 'Name must only contain alpha characters');
            NameOk = false;
        }else {
            setErrorFor(Name);
            NameOk = true;
        }
    }

    if(phonenumberValue === ''){
        setErrorFor(phonenumber, 'Phone number cannot be blank');
        phonenumberOk = false;
    }else {
        if(!phonePattern.test(phonenumberValue)){
            setErrorFor(phonenumber, 'Phone number must only contain numbers');
            phonenumberOk = false;
        }else {
            setErrorFor(phonenumber);
            phonenumberOk = true;
        }
    }

    if (stateValue === ''){
        setErrorFor(state, 'State cannot be blank');
        stateOk = false;
    } else {
        setSuccessFor(state);
        stateOk = true;
    }

    if (postcodeValue === ''){
        setErrorFor(postcode, 'Postcode cannot be blank');
        postcodeOk = false;
    } else {
        if (!postcodePattern.test(postcodeValue)){
            setErrorFor(postcode, 'Postcode is not valid');
            postcodeOk = false;
        } else {
            setSuccessFor(postcode);
            postcodeOk = true;
        }
    }

    if (addressValue === ''){
        setErrorFor(address, 'Address cannot be blank');
        addressOk = false;
    } else {
        setSuccessFor(address);
        addressOk = true;
    }

    if (timeValue === ''){
        setErrorFor(time, 'Please choose a time');
        timeOk = false;
    } else {
        setSuccessFor(time);
        timeOk = true;
    }

    if (NameOk && phonenumberOk && stateOk && postcodeOk && addressOk && timeOk){
        isAllOk = true;
        return isAllOk;
    } else {
        isAllOk = false;
        return isAllOk;
    }

    
}