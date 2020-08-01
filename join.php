<?php
    session_start();

    
        try{
            require_once('connect.php');
            $query = "SELECT * FROM user_info_more WHERE id = :id;";
            $statement = $db->prepare($query);
            $id = $_SESSION['id'];
            $statement->bindValue(':id', $id);
            $statement->execute();
            $fetch = $statement->fetch();
            $statement->closeCursor();
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    
    unset($_SESSION['isJoin']);
    $_SESSION['newJoin'] = 1;
    if($fetch != false) {$_SESSION['isJoin'] = 1; unset($_SESSION['newJoin']);}
    
    if(isset($_SESSION['login_err'])){
?>

<html lang="en"> 
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>COMP1006 - Final Project - Summer 2020 </title>
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
      <p><?php foreach($_SESSION['login_err'] as $err_msg) echo $err_msg;  $_SESSION['login_err'] = null;} else {$_SESSION['login_err'] = null;}?></p>
      <form action="join_process.php" method="post" enctype="multipart/form-data">
        <?php if(isset($_SESSION['isJoin'])){ echo '<div><img src="' . 'profile_pics/' . $fetch['image_id'] . '" caption="profile pic" width="66" length="66"></div>'; }?>
        <label for="location">Location  </label>
        <input type="text" name="location" class="form-control" id="location" value="<?php if(isset($_SESSION['isJoin'])) echo $fetch['location']; ?>">
        <label for="social_url">Social Media URL  </label>
        <input type="text" name="social_url" class="form-control" id="social_url" value="<?php if(isset($_SESSION['isJoin'])) echo $fetch['social_media_URL']; ?>">
        <label for="skill">Skill </label>
        <input type="text" name="skill" class="form-control" id="skill" value="<?php if(isset($_SESSION['isJoin'])) echo $fetch['skill']; ?>">
        <label for="image">Image </label>
        <input type="file" name="image" class="form-control" id="image">
        <input type="submit" name="submit" value="<?php if(isset($_SESSION['isJoin'])) echo "Update";else echo "Join";?>">
 
      </form>
        <nav>
            <ul>
                <li><a href="index.php">Go Back</a></li>
            </ul>
        </nav>
        

        
    </main>
    <footer>
      <p> &copy; 2020 COMP1006 - Final Project </p>
    </footer>
   </div><!--end container-->
  </body>
</html>