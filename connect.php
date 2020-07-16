<?php

    $dsn = 'mysql:host=localhost;dbname=developer_network';
    
    try{
        $db = new PDO($dsn, 'root', 'root');
    }catch(PDOException $e){
        echo "Error: $e->getMessage()";
    }
    
?>
