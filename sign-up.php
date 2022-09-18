<?php
    require_once 'includes/class.php';
    $session = $user->get_session();
    $user->register();

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
    <title>Register an Account</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h3>Sign-up for New Account</h3>
            <form action="" method="post">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Enter First Name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" placeholder="Enter Email Address">
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="number" name="contact" placeholder="Enter Contact Number">
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user_name" placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter Password">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="sign_up">SIGN UP</button>
                </div>
            </form>
            <div style="text-align:center; margin-top:20px;">
                <p>Already have an account?<a href="login.php"> Login</a></p>
                <a href="index.php"> Back to Home</a>
            </div>
        </div>
    </div>
    
</body>
</html>