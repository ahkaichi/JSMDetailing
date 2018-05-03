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
    }
    
    
}

function isChecked(){
    var size = []
    size = Array.from(document.getElementsByClassName("vehicle-type"));
    var flag = false
     
}


function required(x){
    x.preventDefault();
    isEmpty();
    isChecked();
}

vehicle: {
    extra: [0, 10, 20]
}

package: {
    cost: [400, 250, 50]
}
