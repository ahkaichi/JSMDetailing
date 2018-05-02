function isEmpty(){
    var required = []
    required = Array.from( document.getElementsByClassName("package"));
    var flag = false
    flag = required.some(x => x.checked) //checks to see if a package is selected

    if (!flag) {
        alert('Please select a Detailing package first.')
    }
    
}
function required(x){
    x.preventDefault();
    isEmpty();
}

package: {
    cost: [400, 250, 50]
}

