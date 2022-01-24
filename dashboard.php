<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard - Client area</title>
    <?php
    include('module/header.php');
    ?>
</head>
<body>
<?php
include('functions.php');
include('module/auth_session.php');

?><div class="wrapper">
    <div class="form">
        <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
        <p>You are in user dashboard page.</p>
        <p><a href="resetpassword.php?id=<?php print(base64_encode($_SESSION['id'])); ?>&token=<?php print($_SESSION['token']); ?>">Reset Password</a></p>
        <p><a href="logout.php">Logout</a></p>
    </div>
</div><?php

include('module/footer.php');
?>
</body>
</html>