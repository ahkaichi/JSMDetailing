

function isEmpty(){
    var size = []
    size = Array.from(document.getElementsByClassName("vehicle-type"));
    var checked = false
    checked = size.some(x => x.checked)

    if(!checked){
        alert('Select a vehicle size.')
    }
    else{
        var required = []
        required = Array.from( document.getElementsByClassName("package"));
        var flag = false
        flag = required.some(x => x.checked) //checks to see if a package is selected

        if (!flag) {
        alert('Please select a Detailing package first.')
        }
        else {
            totalPrice();
        }
    }
    
    
}


function required(x){
    isEmpty();
    x.preventDefault();
}

function totalPrice() {
    var size = 0;
    var totalCost = 0;
    
    if (document.getElementById("coupe").checked == true) {
        size = 0;
    }
    else if (document.getElementById("sedan").checked == true) {
        size = 10;
        
    }
    else if (document.getElementById("suv").checked == true) {
        size = 20;
    }

    var items = Array.from(document.getElementsByClassName("package"))
    
    for(elem of items) {
        if(elem.checked) {
            totalCost += parseInt(elem.value)
            
        }
    }
    
    totalCost += size;
    //alert(totalCost);
}