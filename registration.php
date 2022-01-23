<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<?php
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
    ?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link">Already have an account? <a href="login.php">Login here</a></p>
    </form>
    <?php
}
?>
</body>
</html>
