<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<?php
include('functions.php');
session_start();

// When form submitted, check and create user session.
if (isset($_POST['username'])) {
    $username = stripslashes($_REQUEST['username']);    // removes backslashes
    $password = stripslashes($_REQUEST['password']);

    // Check user is exist in the database
    $userExist = $classVar->checkUserExist($username, $password);
    if ($userExist) {
        $_SESSION['username'] = $username;

        // Redirect to user dashboard page
        header("Location: dashboard.php");

    } else {
        echo "<div class='form'>
                  <h3>Incorrect Username/password.</h3><br/>
                  <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>
                  </div>";
    }
} else {
    ?><form class="form" method="post" name="login">
        <h1 class="login-title">Login</h1>
        <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true"/>
        <input type="password" class="login-input" name="password" placeholder="Password"/>
        <input type="submit" value="Login" name="submit" class="login-button"/>
        <p class="link">Don't have an account? <a href="registration.php">Registration Now</a></p>
    </form><?php
}
include('module/footer.php');
?>
</body>
</html>