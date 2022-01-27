let uname=document.getElementById("uname");
let unameError=document.getElementById("unameError");

function validateName(){
    if(uname.value==""){
        uname.style.border="2px solid red";
        unameError.innerHTML="*Field Required";
        uname.style.backgroundColor='pink';
        return false;
    }
    else{
        return true;
    }
}

let email=document.getElementById("email");
let emailError=document.getElementById("emailError");

function validateEmail(){
    if(email.value==""){
        email.style.border="2px solid red";
        emailError.innerHTML="*Field Required";
        email.style.backgroundColor='pink';
        return false;
    }
    else{
        return true;
    }
}

let age=document.getElementById("age");
let ageError=document.getElementById("ageError");

function validateAge(){
    if(age.value==""){
        age.style.border="2px solid red";
        ageError.innerHTML="*Field Required";
        age.style.backgroundColor='pink';
        return false;
    }
    else{
        return true;
    }
}

let city=document.getElementById("city");
let cityError=document.getElementById("cityError");

function validateCity(){
    if(city.value==""){
        city.style.border="2px solid red";
        cityError.innerHTML="*Field Required";
        city.style.backgroundColor='pink';
        return false;
    }
    else{
        return true;
    }
}

function validateform(){
    let v1 = validateAge();
    let v2 = validateCity();
    let v3 = validateEmail();
    let v4 = validateName();
    return  (v1 && v2 && v3 && v4) ;
}
