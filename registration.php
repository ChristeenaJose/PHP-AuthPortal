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
if (isset($_REQUEST['username'])) {
    $arrUserReg = array();

    $arrUserReg['username'] = $_REQUEST['username'];
    $arrUserReg['email']    = $_REQUEST['email'];
    $arrUserReg['password'] = $_REQUEST['password'];
    $arrUserReg['re-password'] = $_REQUEST['re-password'];

    // removes Special Characters from insert values.
    $arrUserReg = $classValidation->removeSpecialCharacters($arrUserReg);

    //Server side field validation.
    $resultValidation = $classValidation->registerFormValidation($arrUserReg);

    //Check User Exist.
    $chkUserExist = $classVar->chkUserExistByMail($arrUserReg['email'], $status = false);

    if($resultValidation && !$chkUserExist){

        // When form submitted, insert values into the database.
        $resultUserReg = $classVar->addUserReg($arrUserReg);
        if ($resultUserReg) {
            print("<div class='form'>
                  <h3>Success! Registration has been done, and account activation link has been sent to your email id: ". $arrUserReg['email'] . " </h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>");
        } else {
            print("<div class='form'>
                  <h3>Sorry, Website under construction, Please Try later.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>");
        }
    }
    else if($chkUserExist){
        print( "<div class='form'>
              <h3>Sorry, Email address already exists.</h3><br/>
              <p class='link'>Click here to <a href='login.php'>login</a>.</p>
              </div>");
    }
    else{
        print( "<div class='form'>
              <h3>Sorry, Required fields are missing.</h3><br/>
              <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
              </div>");
    }

} else {
    ?><header>Registration Form</header>
    <form method="post" action="" class="reg_form" name="register">
        <div class="field email">
            <div class="input-area">
                <input type="text" name="email" placeholder="Email Adress" />
                <i class="icon fas fa-envelope"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">Email Adress can't be blank</div>
        </div>

        <div class="field username">
            <div class="input-area">
                <input type="text" name="username" placeholder="Username" />
                <i class="icon fas fa-envelope"></i>
                <i class="error error-icon fas fa-exclamation-circle"></i>
            </div>
            <div class="error error-txt">Username can't be blank</div>
        </div>
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
        <div>
            <a href="forgotpassword.php">Forgot password</a>
            <i class="icon fas fa-hand-sparkles"></i><a href="magiclink.php">Magic Link</a>
        </div>
        <input type="submit" value="Register" name="submit" class="login-button"/>
    </form>
    <div class="sign-txt">Already have an account? <a href="login.php">Login here</a></div><?php
}

?></div><?php
include('module/footer.php');
?>
</body>
</html>
