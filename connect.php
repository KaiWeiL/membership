<?php
    $dsn = 'mysql:host=172.31.22.43;dbname=Kai200436558'; //change the database name
    $db_username = 'Kai200436558';
    $db_password = '77UdOCfej8'; 
    $db = new PDO($dsn, $db_username, $db_password);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>