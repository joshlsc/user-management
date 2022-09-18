<?php

require_once('includes/class.php');
$id = $_GET['id'];
$session = $user->get_session();
$user->restrict_user();
$details = $user->get_details($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="user-details">
            <h2>User Information</h2>
            <p><span style="font-weight:700">First Name : </span> <?= $details['first_name']; ?></p>
            <p><span style="font-weight:700">Last Name : </span><?= $details['last_name']; ?></p>
            <p><span style="font-weight:700">Username : </span> <?= $details['user_name']; ?></p>
            <p><span style="font-weight:700">Email : </span> <?= $details['email']; ?></p>
            <p><span style="font-weight:700">Contact : </span> <?= $details['contact']; ?></p>
            <p><span style="font-weight:700">Status : </span> <?= $details['status']; ?></p>
        </div>


        </div>
    </div>
</body>
</html>