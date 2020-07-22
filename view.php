<!DOCTYPE html>

<?php
    session_start();
    if(isset($_SESSION['isLogin'])){
         
?>
<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <title>View Records</title>
  </head>
  <body>
    <div class="container">
    <header>
      <h1>Modify Your Information</h1>
    </header>
    <main>
        <?php

        require_once('connect.php');

        $query = 'SELECT * FROM user_info WHERE id = :id';
        $statement = $db->prepare($query);
        $statement->bindValue(':id', $_SESSION['id']);
        $statement->execute();
        $record = $statement->fetch();
         ?> 
        
        <tr>
            <td><?php echo $record['first_name']; ?></td>
            <td><?php echo $record['last_name']; ?></td>
            <td><?php echo $record['email']; ?></td>
            <td><a href="delete.php">Delete</a></td>
            <td><a href="register.php">Edit</a></td>
        </tr>

        <?php
            $statement->closeCursor();
        }
        ?>
        <p><a href="index.php">Go Back</a></p>
    </main>
  </body>
</html>