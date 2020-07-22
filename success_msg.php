<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            session_start();
            
            if(isset($_SESSION['isLogin'])){
                echo "<p>Login Success!</p>";
            }
            
            if(isset($_SESSION['register_status'])){
                echo "<p>Register Success!</p>";
                $_SESSION['isLogin'] = 1;
                $_SESSION['register_status'] = null;
            }else if(isset($_SESSION['update'])){
                echo "<p>Update Success!</p>";
                $_SESSION['update'] = null;
            }
            
            
            
            echo "<a href=\"index.php\">Go Back</a>";
        ?>
    </body>
</html>
