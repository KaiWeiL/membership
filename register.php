<?php
    session_start();
    
    $first_name = null;
    $last_name = null;
    $email = null;
    $account = null;
    
    if(isset($_SESSION['id'])){
            require_once('connect.php');
        
            $query = "SELECT * FROM user_info WHERE id = :id";
            $statement = $db->prepare($query);
            $statement->bindValue(':id', $_SESSION['id']);        
            $statement->execute();
            $fetch = $statement->fetch();
            $first_name = $fetch['first_name'];
            $last_name = $fetch['last_name'];
            $email = $fetch['email'];
            $statement->closeCursor();
            
            $query_cred = "SELECT * FROM credential WHERE id = :id";
            $statement_cred = $db->prepare($query_cred);
            $statement_cred->bindValue(':id', $_SESSION['id']);        
            $statement_cred->execute();
            $fetch_cred = $statement_cred->fetch();
            $account = $fetch_cred['account'];
            $statement->closeCursor();
    }
 
    if(isset($_SESSION['login_err'])){
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
      <h1>Login</h1>
    </header>
    <main>
      <p><?php echo $_SESSION['login_err'];  $_SESSION['login_err'] = null;} else {$_SESSION['login_err'] = null;}?></p>
      <form <?php if(!isset($_SESSION['id'])) echo "action=\"register_process.php\""; else echo "action=\"modify.php\"";?> method="post">
        <label for="fname">First Name  </label>
        <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo "$first_name";?>">
        <label for="lname">Last Name  </label>
        <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo "$last_name";?>">
        <label for="email">Email </label>
        <input type="text" name="email" class="form-control" id="email" value="<?php echo "$email";?>">
        <label for="account">Account </label>
        <input type="text" name="account" class="form-control" id="account" value="<?php echo "$account";?>" <?php if(isset($_SESSION['id'])) echo "disabled"; ?>>
        <label for="password">Password </label>
        <input type="password" name="password" class="form-control" id="password" <?php if(isset($_SESSION['id'])) echo "placeholder=\"Re-enter the new password\""; ?>>
        <label for="cfpassword">Confirm Your Password </label>
        <input type="password" name="cfpassword" class="form-control" id="cfpassword" <?php if(isset($_SESSION['id'])) echo "placeholder=\"Confirm the new password\""; ?>>
        <?php if(isset($_SESSION['id'])) {
                echo "<input type=\"submit\" name=\"submit\" value=\"Modify\">";
                
              }else{
                echo "<input type=\"submit\" name=\"submit\" value=\"Register\">";  
              }
        
        ?>
      </form>
        <nav>
            <ul>
                <li><a href="index.php">Go Back</a></li>
            </ul>
        </nav>
        

        
    </main>
    <footer>
      <p> &copy; 2020 COMP1006 - Lab Nine </p>
    </footer>
   </div><!--end container-->
  </body>
</html>