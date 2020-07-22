<?php
    session_start();
    
    $account = trim(filter_input(INPUT_POST, 'account'));
    $password = trim(filter_input(INPUT_POST, 'password'));

    $ok = true;
    $_SESSION['id'] = null;
    $_SESSION['login_err'] = null;
    $_SESSION['user_first_name'] = null;
          
    if(empty($account)){
        $_SESSION['login_err'] = "Cannot have Empty Account Name!";
        $ok = false;
        header('location:login.php');
    }else if(empty($password)){
        $_SESSION['login_err'] = "Cannot have Empty Password!";
        $ok = false;
        header('location:login.php');
    }

        if($ok === true){
            require_once('connect.php');
            $query = 'SELECT * FROM credential WHERE account = :account;';
            $statement = $db->prepare($query);
            $statement->bindValue(':account', $account);
            $statement->execute();
            $crential = $statement->fetch();

                if($statement->rowCount() > 2){
                    $_SESSION['login_err'] = "Something went wrong! Please Contact System Admin!";
                    header('location:login.php');
                }else if($crential['account'] != $account || !password_verify( $password, $crential['passwd'])){
                    $_SESSION['login_err'] = "Account does not exist or Password is not correct!";
                    header('location:login.php');
                }else{
                    $statement->closeCursor();
                    $query_user_info = 'SELECT * FROM user_info WHERE id = :id;';
                    $statement_user_info = $db->prepare($query_user_info);
                    $statement_user_info->bindValue(':id', $crential['id']);
                    $statement_user_info->execute();
                    $crential_user_info = $statement_user_info->fetch();
            
                    $_SESSION['isLogin'] = 1;
                    $_SESSION['user_first_name'] = $crential_user_info['first_name'];
                    $_SESSION['id'] = $crential['id'];
                    header('location:success_msg.php');
                }

        }

?>