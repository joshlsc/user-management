<?php

class user_class {

    // Server Connection
    private $server = "mysql:host=localhost; dbname=registration_db";
    private $user = "root";
    private $password = "";
    private $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
    protected $conn;

/** ----------------------Open Connection---------------------- */
    public function open_conn(){
        try{
            $this->conn = new PDO($this->server, $this->user, $this->password, $this->options);
            return $this->conn;
        }catch(PDOException $e){
            echo "There is a problem in the connection:".$e->getMessage();
        }
    }

/** ----------------------Close Connection--------------------- */
    public function close_conn(){
        $this->conn = NULL;
    }

/** ----------------------404 Page User------------------------ */
    public function show_404(){
        http_response_code(404);
        header('location: 404.php');
        die;
    }

/** ----------------------Check Duplicate User----------------- */
    public function check_existing_user($email){

        $connection = $this->open_conn();
        $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $total = $stmt->rowCount();

        return $total;

        $this->close_conn();

    }

/** ----------------------Register User------------------------ */
    public function register(){

        if(isset($_POST['sign_up'])){

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $user_name = $_POST['user_name'];
            $password = md5($_POST['password']);
            $confirm_password = md5($_POST['confirm_password']);
            $access = 'user';
            $status = 'Active';
            $reg_ok = 0;

            if($password !== $confirm_password){

                echo '<script>alert("Password do not matched!")</script>';
                $reg_ok = 0;

            }else{
                
                if($this->check_existing_user($email) == 0){

                    $connection = $this->open_conn();
                    $stmt = $connection->prepare("INSERT INTO users (`first_name`,`last_name`,`email`,`contact`,`user_name`,`password`,`access`,`status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$first_name, $last_name, $email, $contact, $user_name, $password, $access, $status]);
                    $reg_ok = 1;

                    $this->close_conn();

                    echo '<script>alert("Account successfully created!")</script>';

                }else{
                    echo 'User already exists!';
                }

                if($reg_ok == 1){

                    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ? && password = ?");
                    $stmt->execute([$email, $password]);
                    $user = $stmt->fetch();
                    $total = $stmt->rowCount();
        
                    if($total > 0){
                        $this->set_session($user);
                        header('location: index.php');
                    }
                    $this->close_conn();
                }
            }
        }
    }
/** ----------------------User Login--------------------------- */
    public function user_login(){

        if(isset($_POST['login'])){

            $user_name = $_POST['user_name'];
            $password = md5($_POST['password']);

            $connection = $this->open_conn();
            $stmt = $connection->prepare("SELECT * FROM users WHERE user_name = ? && password = ?");
            $stmt->execute([$user_name, $password]);
            $user = $stmt->fetch();
            $total = $stmt->rowCount();

            if($total > 0){
                $this->set_session($user);
                header('location: index.php');
            }else{
                echo "<script>alert('Login failed! Please check your username and password')</script>";
            }

            $this->close_conn();

        }
    }

/** ----------------------Restrict User------------------------ */
    public function restrict_user(){

        if(!isset($_SESSION)){
            session_start();
        }

        if(empty($_SESSION['userdata'])){
            return $this->show_404();
            die;
        }

        if($_SESSION['userdata']['access'] == 'user'){
            return $this->show_404();
            die;
        }
    }

/** ----------------------User Logout-------------------------- */
    public function user_logout(){

        if(!isset($SESSION)){
            session_start();
        }

        $_SESSION['userdata'] = NULL;
        unset($_SESSION['userdata']);
        header('location: login.php');

    }
/** ----------------------Set Session-------------------------- */
    public function set_session($array){

        if(!isset($SESSION)){
            session_start();
        }

        $_SESSION['userdata'] = array(
            "fullname" => $array['first_name']." ".$array['last_name'],
            "user_name" => $array['user_name'],
            "access" => $array['access'],
            "user_id" => $array['user_id'],
            "email" => $array['email'],
            );

            return $_SESSION['userdata'];
    }

/** ----------------------Get Session-------------------------- */
    public function get_session(){

        if(!isset($SESSION)){
            session_start();
        }

        if(isset($_SESSION['userdata'])){
            return $_SESSION['userdata']; 

        }else{
            return NULL;
        }

    }

/** ----------------------Get Users---------------------------- */
    public function get_users(){

        $connection = $this->open_conn();
        $stmt = $connection->prepare("SELECT * FROM users ORDER BY `user_id` DESC");
        $stmt->execute();
        $users = $stmt->fetchAll();
        $total = $stmt->rowCount();

        if($total > 0){
            return $users;
        }else{
            return FALSE;
        }

        $this->close_conn();
    }

/* -----------------------Get User Details--------------------- */
    public function get_details($id){

        $connection = $this->open_conn();     
        $stmt = $connection->prepare("SELECT * FROM users WHERE user_id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch();
        $total = $stmt->rowCount();

        if($total > 0){
            return $user;
        }else{
            return $this->show_404();
        }

        $this->close_conn();
    }

/** ----------------------Update User Details------------------ */
    public function update_user($id){

        if(isset($_POST['update'])){

            $u_name = $_POST['user_name'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $status = $_POST['status'];
    
            $connection = $this->open_conn();
            $stmt = $connection->prepare("UPDATE users SET user_name=?, first_name=?, last_name=?, email=?, contact=?, status=? WHERE user_id = $id");
            $stmt->execute([$u_name, $first_name, $last_name, $email, $contact, $status]);
                        
            $this->close_conn();
            header('location: user-details.php?id='.$id);
        }
    }




}
// Class Instantiation
$user = new user_class();