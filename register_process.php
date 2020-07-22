<?php

    session_start();
    
    $first_name = filter_input(INPUT_POST, 'first_name');
    $last_name = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $account = filter_input(INPUT_POST, 'account');
    $password = filter_input(INPUT_POST, 'password');
    $cfpassword = filter_input(INPUT_POST, 'cfpassword');


    $ok = true;
    $_SESSION['login_err'] = null;
    $_SESSION['register_status'] = null;

    //A series of input verification
    if (empty($first_name) || empty($last_name)) {
        $_SESSION['login_err'] = "Please provide both first and last name!";
        $ok = false;
        header('location:register.php');
    }else if (empty($email)) {
        $_SESSION['login_err'] = "Email cannot be empty!";
        $ok = false;
        header('location:register.php');
    }else if(empty($account)){
        $_SESSION['login_err'] = "Account Name Empty!";
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
        require_once('connect.php');
        
        $query = "SELECT * FROM credential WHERE account = :account";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':account', $account);        
        $statement->execute();
        $fetch = $statement->fetch();
        
        if(!isset($fetch['account'])){
            $statement->closeCursor();

            $query = "INSERT INTO user_info (first_name, last_name, email) VALUES (:first_name, :last_name, :email);";

            $statement = $db->prepare($query);
            $statement->bindValue(':first_name', $first_name);
            $statement->bindValue(':last_name', $last_name);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $statement->closeCursor();

            $query = "SELECT * FROM user_info WHERE first_name = :first_name";

            $statement = $db->prepare($query);
            $statement->bindValue(':first_name', $first_name);        
            $statement->execute();
            $fetch = $statement->fetch();
            $id = $fetch['id'];
            $statement->closeCursor();

            $query = "INSERT INTO credential (id, account, passwd) VALUES (:id, :account, :password);";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $id);
            $statement->bindValue(':account', $account);
            $hash_password = password_hash($password, PASSWORD_DEFAULT);
            $statement->bindValue(':password', $hash_password);
            $statement->execute();
            $statement->closeCursor();


            $_SESSION['user_first_name'] = $first_name;
            $_SESSION['id'] = $id;
            $_SESSION['register_status'] = 1;
            header('location: success_msg.php');
        }else{
            $_SESSION['login_err'] = "sorry, the account name has been taken!";
            $ok = false;
            header('location:register.php');
        }
    }

?>

