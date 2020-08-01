<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title> 2020 COMP1006 - Final Project </title>
    </head>
    <body>
        <?php
            session_start();
            
            
           if(isset($_SESSION['isLogin']) && isset($_SESSION['isJoin']) && !isset($_SESSION['newJoin']) && !isset($_SESSION['isPersonalInfoUpdate'])){
                echo "<p>Welcome Back to the Community!</p>";
            }
            
            if(isset($_SESSION['newJoin'])){
                echo "<p>Welcome to the Community! Hope you enjoy your journey of connection!</p>";
                unset($_SESSION['newJoin']);
            }
            
            if(isset($_SESSION['isPersonalInfoUpdate'])){
                echo "<p>Personal Information Update Success!</p>";
                unset($_SESSION['isPersonalInfoUpdate']);
            }
            
            
            if(isset($_SESSION['isLogin']) && !isset($_SESSION['isJoin'])){
                echo "<p>Login Success!</p>";
            }
            
            
            if(isset($_SESSION['register_status'])){
                echo "<p>Register Success!</p>";
                $_SESSION['isLogin'] = 1;
                $_SESSION['register_status'] = null;
            }else if(isset($_SESSION['update'])){
                echo "<p>Account Update Success!</p>";
                $_SESSION['update'] = null;
            }
            
            
            unset($_SESSION['newJoin']);
            echo "<a href=\"index.php\">Go Back</a>";
        ?>
    </body>
</html>
