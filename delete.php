<?php

session_start();

$id = $_SESSION['id'];

require_once('connect.php');

$sql = 'DELETE FROM credential WHERE id = :id';

$statement = $db->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$statement->closeCursor();


$sql = 'DELETE FROM user_info WHERE id = :id';

$statement = $db->prepare($sql);
$statement->bindValue(':id', $id);
$statement->execute();
$statement->closeCursor();

$_SESSION['isLogin'] = null;
$_SESSION['register_status'] = null;

header('location:view.php');
?>