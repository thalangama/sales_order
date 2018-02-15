/**
 * Created by Madushanka on 2/15/2018.
 */
function clearFields() {
    document.getElementById('current_password').value = "";
    document.getElementById('new_password').value = "";
    document.getElementById('confirm_password').value = "";
}

function validateForm(){
    var current_password = document.getElementById('current_password');
    var new_password = document.getElementById('new_password');
    var confirm_password = document.getElementById('confirm_password');

    if(current_password.value == "" || new_password.value == "" || confirm_password.value =="" ){
        alert('please fill all fields!');
        clearFields();
        return false;
    }
    if(new_password.value != confirm_password.value ){
        alert('password confirmation is invalid. please try again!');
        clearFields();
        return false;
    }

    return true;
}