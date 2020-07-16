<?php
    ob_start();

    try{
    $user_id = filter_input(INPUT_GET, 'id');

    require_once('connect.php');
    $sql = 'DELETE FROM developer_info WHERE id = :user_id';
    $statement = $db->prepare($sql);
    $statement->bindParam(':user_id', $user_id);
    $statement->execute();  
    header('location:view.php');

    }catch(PDOException $e) {
        $error_message = $e->getMessage(); 
        echo "<p> $errormessage </p>"; 
    }
    ob_flush();
?>