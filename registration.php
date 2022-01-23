<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<div class="wrapper"><?php
include('functions.php');

// When form submitted, insert values into the database.
if (isset($_REQUEST['username'])) {
    $arrUserReg = array();

    // removes backslashes
    $arrUserReg['username'] = stripslashes($_REQUEST['username']);
    $arrUserReg['email']    = stripslashes($_REQUEST['email']);
    $arrUserReg['password'] = stripslashes($_REQUEST['password']);


    // When form submitted, insert values into the database.
    $resultUserReg = $classVar->addUserReg($arrUserReg);

    if ($resultUserReg) {
        echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a></p>
                  </div>";
    } else {
        echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
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

        <input type="submit" value="Register" name="submit" class="login-button" />
    </form>
    <div class="sign-txt">Already have an account? <a href="login.php">Login here</a></div><?php
}

?></div><?php
include('module/footer.php');
?>
</body>
</html>
