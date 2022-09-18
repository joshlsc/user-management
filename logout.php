<?php
    require_once 'includes/class.php';
    $user->user_logout();
    header('location: login.php');
