<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login Form</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>

<div class="wrapper"><?php
    include('functions.php');
    session_start();

    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // removes backslashes
        $password = stripslashes($_REQUEST['password']);

        // Check user is exist in the database
        $userExist = $classVar->checkUserLogin($username, $password);

        if ($userExist && $userExist > 0) {
            $arrUserInfo = $classVar->getUserInfoById($userExist);
            $_SESSION['username'] = $username;
            $_SESSION['id'] = $arrUserInfo['id'];
            $_SESSION['token'] = $arrUserInfo['token'];

            // Redirect to user dashboard page
            header("Location: dashboard.php");

        } else {
            if($classVar->chkUserExistByUserNamePass($username, $password)){
                print("<div class='form'>
                  <h3>Account activation pending, Please check your email!</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>");
            }
            else{
                print("<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  <p class='link'>or</p>
                  <p class='link'>Not yet member? <a href='registration.php'>Signup now</a></p>
                  </div>");
            }
        }
    } else {
    ?>
    <header>Login Form</header>
    <form action="" method="post" class="login_form" name="login">
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
        <div>
            <a href="forgotpassword.php">Forgot password</a>
            <i class="icon fas fa-hand-sparkles"></i><a href="magiclink.php">Magic Link</a>
        </div>
        <input type="submit" value="Login" name="submit" class="login-button" />
    </form>
    <div class="sign-txt">Not yet member? <a href="registration.php">Signup now</a></div><?php
}
?></div><?php
include('module/footer.php');
?>
</body>
</html>