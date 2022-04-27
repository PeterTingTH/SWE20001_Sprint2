var gttl = 0;
var iprice = document.getElementsByClassName('iprice');
var iquantity = document.getElementsByClassName('iquantity');
var itotal = document.getElementsByClassName('itotal');
var total = document.getElementById('total');


function subtotal() {
    gttl = 0;
    for (i = 0; i < iprice.length; i++) {
        itotal[i].innerHTML = '$' + (iprice[i].value) * (iquantity[i].value);
        gttl = gttl + (iprice[i].value) * (iquantity[i].value);
    }
    total.innerHTML = gttl;
}


subtotal();