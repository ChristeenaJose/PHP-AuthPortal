<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<div class="loader" style="display: none" id="loader"></div>
<div class="wrapper"><?php
    include('functions.php');
    include('module/validations.php');

    // When form submitted, insert values into the database.
    if (isset($_REQUEST['email']) && isset($_REQUEST['forgotPass'])) {
        $arrUserReg = array();
        $arrUserReg['email']    = $_REQUEST['email'];

        // removes Special Characters from insert values.
        $arrUserReg = $classValidation->removeSpecialCharacters($arrUserReg);

        //Server side field validation.
        $resultValidation = $classValidation->registerFormValidation($arrUserReg);

        //Check User Exist.
        $chkUserId = $classVar->chkUserForgotPass($arrUserReg['email']);
        $chkUserId = $chkUserId['id'];

        if($resultValidation && $chkUserId > 0){

            // When form submitted, Generate Token and insert values into the database, and Send mail.
            $resultForgotPass = $classVar->generateForgotPasswordToken($arrUserReg, $chkUserId);

            if ($resultForgotPass) {
                print("<div class='form'>
                  <h3>Success! Password reset link has been sent to your email id: ". $arrUserReg['email'] . " </h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>");
            } else {
                print("<div class='form'>
                  <h3>Website under construction, Please Try later.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>");
            }
        }
        else if($chkUserId == 0){
            print( "<div class='form'>
              <h3>Email address not exists.</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
              </div>");
        }
        else{
            print( "<div class='form'>
              <h3>Required fields are missing.</h3><br/>
              <p class='link'>Click here to <a href='forgotpassword.php'>reset password</a> again.</p>
              </div>");
        }

    } else {
        ?><header>Forgot Password</header>
        <form method="post" action="" class="forgotPass_form" name="forgotPass">
            <div class="field email">
                <div class="input-area">
                    <input type="text" name="email" placeholder="Email Adress" />
                    <i class="icon fas fa-envelope"></i>
                    <i class="error error-icon fas fa-exclamation-circle"></i>
                </div>
                <div class="error error-txt">Email Adress can't be blank</div>
            </div>
            <input type="hidden" name="forgotPass" value=True />
            <input type="submit" value="Request Password" name="submit" class="login-button"/>
        </form>
        <div class="sign-txt">Already have an account? <a href="login.php">Login here</a></div><?php
    }

    ?></div><?php
include('module/footer.php');
?>
</body>
</html>
