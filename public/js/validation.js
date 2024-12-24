function validateMobile() {
    var el = document.getElementsByClassName('mobileNum');
    for (let i of el) {
        if(i.value.length>9){
            i.value = i.value.substring(0,9);
        }
    }
}

function validateZip() {
    var el = document.getElementsByClassName('zipNum');
    for (let i of el) {
        if(i.value.length>5){
            i.value = i.value.substring(0,5);
        }
    }
}