<?php
    require_once 'includes/class.php';
    $session = $user->get_session();
    $users = $user->get_users();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <div class="container">

        <div class="title-container">
            <h1>Welcome <?= (isset($session)) ? ''.$session['user_name'].'!' : 'Guest!';?></h1>
        </div>

        <div class="table-content">
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Access</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $user){ ?>
                    <tr>
                        <td><?= $user['first_name'] ?></td>
                        <td><?= $user['last_name'] ?></td>
                        <td><?= $user['user_name'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['contact'] ?></td>
                        <td><?= $user['access'] ?></td>
                        <td><?= $user['status'] ?></td>
                        <td>
                            <ul class="actions">
                            <?php if(isset($session)){ ?>
                                <?php if($session['user_name'] && $session['access'] == 'administrator'){ ?>
                                    <li><a href="user-details.php?id=<?= $user['user_id']; ?>">View</a></li>
                                    <li><a href="edit-user.php?id=<?= $user['user_id']; ?>">Edit</a></li>
                                <?php }elseif($session['user_name'] && $session['access'] == 'user'){ ?>
                                    <li><a href="user-details.php?id=<?= $user['user_id']; ?>">View</a></li>
                            </ul>
                                <?php }else{ ?>   
                                    <p style="color:#0099ff;">Not Available</p>
                                <?php } ?>
                            <?php }else{ ?>
                                <p style="color:#0099ff;">Not Available</p>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>                    
        </div>

    </div>

</body>
</html>