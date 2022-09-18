<?php
    require_once 'includes/class.php';
    $session = $user->get_session();
    $user->user_login();

    if(!empty($session)) {
        header ('location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to your Account</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3>User Login</h3>
            <form class="login-form" action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user_name" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="text" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="login">LOGIN</button>
                </div>
            </form>
            <div class="form-link">
                <a href="sign-up.php">Create an Account</a>
                <a href="index.php">Back to Home</a>
            </div>
        </div>
    </div>
    
</body>
</html>