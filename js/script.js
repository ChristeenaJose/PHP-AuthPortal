//Validation for login form
const logForm = document.querySelector(".login_form");
if(logForm !== null){
    uField = logForm.querySelector(".username");
    uInput = uField.querySelector("input");
    pField = logForm.querySelector(".password");
    pInput = pField.querySelector("input");

    logForm.onsubmit = (e)=>{

        //if email and password is blank then add shake class in it else call specified function
        (uInput.value == "") ? uField.classList.add("shake", "error") : checkUser();
        (pInput.value == "") ? pField.classList.add("shake", "error") : checkPass();

        setTimeout(()=>{ //remove shake class after 500ms
            uField.classList.remove("shake");
            pField.classList.remove("shake");
        }, 500);

        uInput.onkeyup = ()=>{checkUser();} //calling checkEmail function on email input keyup
        pInput.onkeyup = ()=>{checkPass();} //calling checkPassword function on pass input keyup

        function checkUser(){ //checkUser function
            if(uInput.value == ""){ //if username is empty then add error and remove valid class
                uField.classList.add("error");
                uField.classList.remove("valid");
            }
            else{ //if username is empty then remove error and add valid class
                uField.classList.remove("error");
                uField.classList.add("valid");
            }
        }
        function checkPass(){ //checkPass function
            if(pInput.value == ""){ //if pass is empty then add error and remove valid class
                pField.classList.add("error");
                pField.classList.remove("valid");
            }
            else{ //if pass is empty then remove error and add valid class
                pField.classList.remove("error");
                pField.classList.add("valid");
            }
        }

        //if uField and pField doesn't contains error class that mean user filled details properly
        if(uField.classList.contains("error") || pField.classList.contains("error")){
            e.preventDefault(); //preventing from form submitting
        }
    }
}

//Validation for Register form
const regForm = document.querySelector(".reg_form");
if(regForm !== null){
    eField = regForm.querySelector(".email"),
        eInput = eField.querySelector("input"),
        uField = regForm.querySelector(".username"),
        uInput = uField.querySelector("input"),
        pField = regForm.querySelector(".password"),
        pInput = pField.querySelector("input");
        rpField = regForm.querySelector(".re-password"),
        rpInput = rpField.querySelector("input");

    regForm.onsubmit = (e)=>{

        //if email and password is blank then add shake class in it else call specified function
        (eInput.value == "") ? eField.classList.add("shake", "error") : checkEmail();
        (uInput.value == "") ? uField.classList.add("shake", "error") : checkUser();
        (pInput.value == "") ? pField.classList.add("shake", "error") : checkPass();
        (rpInput.value == "") ? rpField.classList.add("shake", "error") : checkRePass();

        setTimeout(()=>{ //remove shake class after 500ms
            eField.classList.remove("shake");
            uField.classList.remove("shake");
            pField.classList.remove("shake");
            rpField.classList.remove("shake");
        }, 500);

        eInput.onkeyup = ()=>{checkEmail();} //calling checkEmail function on email input keyup
        uInput.onkeyup = ()=>{checkUser();} //calling checkEmail function on email input keyup
        pInput.onkeyup = ()=>{checkPass();} //calling checkPassword function on pass input keyup
        rpInput.onkeyup = ()=>{checkRePass();} //calling checkPassword function on pass input keyup

        function checkEmail(){ //checkEmail function
            let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/; //pattern for validate email
            if(!eInput.value.match(pattern)){ //if pattern not matched then add error and remove valid class
                eField.classList.add("error");
                eField.classList.remove("valid");
                let errorTxt = eField.querySelector(".error-txt");

                //if email value is not empty then show please enter valid email else show Email can't be blank
                (eInput.value != "") ? errorTxt.innerText = "Enter a valid email address" : errorTxt.innerText = "Email can't be blank";
            }
            else{ //if pattern matched then remove error and add valid class
                eField.classList.remove("error");
                eField.classList.add("valid");
            }
        }

        function checkUser(){ //checkUser function
            if(uInput.value == ""){ //if pass is empty then add error and remove valid class
                uField.classList.add("error");
                uField.classList.remove("valid");
            }
            else{ //if pass is empty then remove error and add valid class
                uField.classList.remove("error");
                uField.classList.add("valid");
            }
        }

        function checkPass(){ //checkPass function
            if(pInput.value == ""){ //if pass is empty then add error and remove valid class
                pField.classList.add("error");
                pField.classList.remove("valid");
            }
            else{ //if pass is empty then remove error and add valid class
                pField.classList.remove("error");
                pField.classList.add("valid");
            }
        }

        function checkRePass(){ //checkPass function
            if(rpInput.value == ""){ //if pass is empty then add error and remove valid class
                rpField.classList.add("error");
                rpField.classList.remove("valid");
            }
            else if(rpInput.value != pInput.value){ //if pass is not equal to repeat password
                rpField.classList.add("error");
                rpField.classList.remove("valid");
            }
            else{ //if pass is empty then remove error and add valid class
                rpField.classList.remove("error");
                rpField.classList.add("valid");
            }

            let errorTxt = rpField.querySelector(".error-txt");
            (rpInput.value != "") ? errorTxt.innerText = "Passwords do not match" : errorTxt.innerText = "Repeat Password can't be blank";
        }

        //if uField and pField and eField doesn't contains error class that mean user filled details properly
        if(rpField.classList.contains("error") || eField.classList.contains("error") || uField.classList.contains("error") || pField.classList.contains("error")){
            e.preventDefault(); //preventing from form submitting
        }
        else{
            document.getElementById('loader').style.display = '';
        }
    }
}

//Validation for Forgot password form
const forgotPassForm = document.querySelector(".forgotPass_form");
if(forgotPassForm !== null){
        eField = forgotPassForm.querySelector(".email"),
        eInput = eField.querySelector("input"),

        forgotPassForm.onsubmit = (e)=>{

        //if email and password is blank then add shake class in it else call specified function
        (eInput.value == "") ? eField.classList.add("shake", "error") : checkEmail();

        setTimeout(()=>{ //remove shake class after 500ms
            eField.classList.remove("shake");
        }, 500);

        eInput.onkeyup = ()=>{checkEmail();} //calling checkEmail function on email input keyup

        function checkEmail(){ //checkEmail function
            let pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/; //pattern for validate email
            if(!eInput.value.match(pattern)){ //if pattern not matched then add error and remove valid class
                eField.classList.add("error");
                eField.classList.remove("valid");
                let errorTxt = eField.querySelector(".error-txt");

                //if email value is not empty then show please enter valid email else show Email can't be blank
                (eInput.value != "") ? errorTxt.innerText = "Enter a valid email address" : errorTxt.innerText = "Email can't be blank";
            }
            else{ //if pattern matched then remove error and add valid class
                eField.classList.remove("error");
                eField.classList.add("valid");
            }
        }

        //if eField doesn't contains error class that mean user filled details properly
        if(eField.classList.contains("error")){
            e.preventDefault(); //preventing from form submitting
        }
        else{
            document.getElementById('loader').style.display = '';
        }
    }
}

//Validation for Reset password form
const reSetPassForm = document.querySelector(".reSetPass_form");
if(reSetPassForm !== null){
        pField = reSetPassForm.querySelector(".password"),
        pInput = pField.querySelector("input");
        rpField = reSetPassForm.querySelector(".re-password"),
        rpInput = rpField.querySelector("input");

    reSetPassForm.onsubmit = (e)=>{

        //if email and password is blank then add shake class in it else call specified function
        (pInput.value == "") ? pField.classList.add("shake", "error") : checkPass();
        (rpInput.value == "") ? rpField.classList.add("shake", "error") : checkRePass();

        setTimeout(()=>{ //remove shake class after 500ms
            pField.classList.remove("shake");
            rpField.classList.remove("shake");
        }, 500);

        pInput.onkeyup = ()=>{checkPass();} //calling checkPassword function on pass input keyup
        rpInput.onkeyup = ()=>{checkRePass();} //calling checkPassword function on pass input keyup

        function checkPass(){ //checkPass function
            if(pInput.value == ""){ //if pass is empty then add error and remove valid class
                pField.classList.add("error");
                pField.classList.remove("valid");
            }
            else{ //if pass is empty then remove error and add valid class
                pField.classList.remove("error");
                pField.classList.add("valid");
            }
        }

        function checkRePass(){ //checkPass function
            if(rpInput.value == ""){ //if pass is empty then add error and remove valid class
                rpField.classList.add("error");
                rpField.classList.remove("valid");
            }
            else if(rpInput.value != pInput.value){ //if pass is not equal to repeat password
                rpField.classList.add("error");
                rpField.classList.remove("valid");
            }
            else{ //if pass is empty then remove error and add valid class
                rpField.classList.remove("error");
                rpField.classList.add("valid");
            }

            let errorTxt = rpField.querySelector(".error-txt");
            (rpInput.value != "") ? errorTxt.innerText = "Passwords do not match" : errorTxt.innerText = "Repeat Password can't be blank";
        }

        //if pField and rpField doesn't contains error class that mean user filled details properly
        if(rpField.classList.contains("error") || pField.classList.contains("error")){
            e.preventDefault(); //preventing from form submitting
        }
    }
}