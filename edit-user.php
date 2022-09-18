<?php

require_once('includes/class.php');
$id = $_GET['id'];
$session = $user->get_session();
$user->restrict_user();
$details = $user->get_details($id);
$user->update_user($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <div class="container">
        <div class="title-container">
            <h2>Edit User Information</h2>
        </div>
        <div class="form-container">
            <form class="edit-form" action="" method="post">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="user_name" placeholder="Enter New Username" value="<?= $details['user_name']?>">
                </div>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" placeholder="Enter First Name" value="<?= $details['first_name']?>">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" placeholder="Enter Last Name" value="<?= $details['last_name']?>">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" id="">
                        <option value="Active" <?= ($details['status'] == "Active")? 'selected': '';?> >Active</option>
                        <option value="Inactive" <?= ($details['status'] == "Inactive")? 'selected': '';?> >Inactive</option>
                        <option value="Banned" <?= ($details['status'] == "Banned")? 'selected': '';?> >Banned</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="Enter Email" value="<?= $details['email']?>">
                </div>
                <div class="form-group">
                    <label>Contact</label>
                    <input type="number" name="contact" placeholder="Enter Contact" value="<?= $details['contact']?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary" type="submit" name="update">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>