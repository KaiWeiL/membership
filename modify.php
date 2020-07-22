<?php
           
session_start();
if(isset($_SESSION['id'])){

    require_once('connect.php');
    
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    $cfpassword = filter_input(INPUT_POST, 'cfpassword');
    
    $ok = true;
    
       //A series of input verification
    if (empty($first_name) || empty($last_name)) {
        $_SESSION['login_err'] = "Please provide both first and last name!";
        $ok = false;
        header('location:register.php');
    }else if (empty($email)) {
        $_SESSION['login_err'] = "Email cannot be empty!";
        $ok = false;
        header('location:register.php');
    }else if(empty($password)){
        $_SESSION['login_err'] = "Password Empty!";
        $ok = false;
        header('location:register.php');
    }else if(empty($cfpassword)){
        $_SESSION['login_err'] = "Please confirm the password!";
        $ok = false;
        header('location:register.php');
    }else if($cfpassword != $password){
        $_SESSION['login_err'] = "Password does not match with confirm password!";
        $ok = false;
        header('location:register.php');
    }

    if($ok === true){
        $query = "UPDATE user_info SET first_name = :first_name, last_name = :last_name, email = :email;";

        $statement = $db->prepare($query);
        $statement->bindValue(':first_name', $first_name);
        $statement->bindValue(':last_name', $last_name);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $statement->closeCursor();

        $query_cred = "UPDATE credential SET passwd = :password;";

        $statement_cred = $db->prepare($query_cred);
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
        $statement_cred->bindValue(':password', $hash_password);
        $statement_cred->execute();
        $statement_cred->closeCursor();

        $_SESSION['isLogin'] = null;
        $_SESSION['id'] = null;
        $_SESSION['update'] = 1;
        header('location:success_msg.php');
    }
}
?>
