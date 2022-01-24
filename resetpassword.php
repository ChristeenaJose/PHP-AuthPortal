<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<div class="wrapper"><?php
    include('functions.php');
    include('module/validations.php');

    if (isset($_GET["id"]) && isset($_GET["token"]) && !isset($_REQUEST['resetPass'])) {
        $id = intval(base64_decode($_GET["id"]));
        $token = $_GET["token"];

        $chkUserExist = $classVar->chkUserExistForPasswordUpdate($id, $token);
        if($chkUserExist){
            $resultActivateUser = $classVar->activateUser($id);
            if($resultActivateUser){
                ?><header>Reset Password</header>
                <form method="post" action="" class="reSetPass_form" name="reSetPass">
                    <div class="field password">
                        <div class="input-area">
                            <input type="password" name="password" placeholder="Password" />
                            <i class="icon fas fa-lock"></i>
                            <i class="error error-icon fas fa-exclamation-circle"></i>
                        </div>
                        <div class="error error-txt">Password can't be blank</div>
                    </div>

                    <div class="field re-password">
                        <div class="input-area">
                            <input type="password" name="re-password" placeholder="Repeat Password" />
                            <i class="icon fas fa-lock"></i>
                            <i class="error error-icon fas fa-exclamation-circle"></i>
                        </div>
                        <div class="error error-txt">Repeat Password can't be blank</div>
                    </div>
                    <input type="submit" value="Update Password" name="submit" class="login-button"/>
                    <input type="hidden" name="resetPass" value="True" />
                    <input type="hidden" name="userId" value=<?php print($id); ?> />
                    <input type="hidden" name="userToken" value=<?php print($token); ?> />
                </form>
                <div class="sign-txt">Already have an account? <a href="login.php">Login here</a></div><?php
            }
        }
        else{
            print("<div class='form'>
                  <h3>Sorry, you have no permission to access this service</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>");
        }
    }
    elseif(isset($_REQUEST['resetPass'])){
        $arrUserReg = array();

        $arrUserReg['token'] = $_REQUEST['userToken'];
        $arrUserReg['id']    = $_REQUEST['userId'];
        $arrUserReg['password'] = $_REQUEST['password'];
        $arrUserReg['re-password'] = $_REQUEST['re-password'];

        // removes Special Characters from insert values.
        $arrUserReg = $classValidation->removeSpecialCharacters($arrUserReg);

        //Server side field validation.
        $resultValidation = $classValidation->registerFormValidation($arrUserReg);

        //Check User Exist.
        $chkUserExist = $classVar->chkUserExistById($arrUserReg['id']);

        if($resultValidation && $chkUserExist){

            // When form submitted, insert values into the database.
            $resultUserReg = $classVar->resetPassword($arrUserReg);

            if ($resultUserReg) {
                print("<div class='form'>
                      <h3>Success! Password updated successfully.</h3><br/>
                      <p class='link'>Click here to <a href='login.php'>Login</a></p>
                      </div>");
            }
            else {
                print("<div class='form'>
                      <h3>Website under construction, Please Try later.</h3><br/>
                      <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                      </div>");
            }
        }
        else{
            print( "<div class='form'>
                  <h3>Sorry, Email address is not exists.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a>.</p>
                  </div>");
        }
    }
    else{
        header("Location: login.php");
    }
    ?></div><?php
include('module/footer.php');
?>
</body>
</html>