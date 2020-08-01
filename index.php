<?php
    session_start();
    
    $fetch = null;
    if(isset($_SESSION['id'])){
        try{
        require_once('connect.php');
        $query = "SELECT * FROM user_info_more WHERE id = :id;";       
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $_SESSION['id']);
        $statement->execute();
        $fetch = $statement->fetch();
        if(isset($fetch['id'])){
            $_SESSION['isJoin'] = 1;
        }else{
            $_SESSION['isJoin'] = null;
        }}catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }
        
    if(isset($_SESSION['isLogin'])){
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>COMP1006 - Lab 9 - Summer 2020 </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Piedra&family=Quicksand&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <header>
      <h1> COMP1006 - Lab Nine!</h1>
    </header>
    <main>
    <?php         
        echo '<h2>Welcome! '.$_SESSION['user_first_name'].' </h2>';
        if(isset($_SESSION['isJoin'])){
        echo  '<nav>'.
                '<ul>'.
                    '<li><a href="view.php?id="'.$_SESSION['id'].'">Modify Account Information</a></li>'.
                    '<li><a href="join.php">Modify Personal Information</a></li>'.
                    '<li><a href="overview.php">View Network</a></li>'.
                    '<li><a href="session_destroy.php">Logout</a></li>'.
                '</ul>'.
               '</nav>';
        
        }else{
            echo'<nav>'.
                '<ul>'.
                    '<li><a href="view.php?id="'.$_SESSION['id'].'">Modify Account Information</a></li>'.
                    '<li>Let\'s connected and <a href="join.php">Join Community</a></li>'.
                    '<li><a href="session_destroy.php">Logout</a></li>'.
                    '</ul>'.
                '</nav>';
        }
    }else{    
        echo '<h2>Welcome to the community!</h2>'.
             '<h3>Let\'s Join and Incorporate!</h3>';
        echo  '<nav>'.
            '<ul>'.
                '<li><a href="login.php">Login</a></li>'.
                '<li><a href="register.php">Register</a></li>'.
            '</ul>'.
        '</nav>';
        $_SESSION['isLogin'] = null;
        

    }?>

    <div><a href="review.html">Final Project Review</a></div>
    </main>
    <footer>
      <p> &copy; 2020 COMP1006 - Final Project </p>
    </footer>
   </div><!--end container-->
  </body>
</html>