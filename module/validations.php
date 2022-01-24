<?php

//Class for db connection
class fieldValidations{

    function __construct(){
    }

    // Function for register form validation
    function registerFormValidation($arrUserReg) {
        foreach($arrUserReg as $key => $value){

            if (empty($value)) {
                return false;
            }
            elseif ($key == 'email'){
                if(!$this->checkEmail($value)){
                    return false;
                }
            }
            elseif ($key == 're-password'){
                if($value != $arrUserReg['password']){
                    return false;
                }
            }
        }
        return true;
    }

    // Function for remove special characters
    function removeSpecialCharacters($data) {
        foreach ($data as $key => $value){
            $value = trim($value);
            $value = stripslashes($value);
            $value = htmlspecialchars($value);
            $data[$key] = $value;
        }
        return $data;
    }

    // Function for checking email.
    function checkEmail($email) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)) ? FALSE : TRUE;
    }
}
$classValidation = new fieldValidations();

?>