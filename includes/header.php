<header>
    <div class="nav-container">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            <?php if(!empty($session)) { ?>
                <li><a href="logout.php">Logout</a></li>
            <?php }else{ ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="sign-up.php">Signup</a></li>
            <?php } ?>
            </ul>
        </nav>
    </div>
</header>