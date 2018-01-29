/**
 * Created by Madushanka on 1/29/2018.
 */

function checkPassword(){
    var newPassword = document.getElementById("newPassword");
    var confirmPassword = document.getElementById("confirmPassword");
    if(newPassword.value != confirmPassword.value){
        confirmPassword.value="";
        newPassword.value="";
        alert("Password confirmation is invalid, Please try again!");
        return false;
    }
    else
        return true;
}
