<?php
    session_start();

   $location = filter_input(INPUT_POST, 'location');
   $social_url = filter_input(INPUT_POST, 'social_url');
   $skill = filter_input(INPUT_POST, 'skill');
   
   $image_tmp = $_FILES['image']['tmp_name'];
   $image_name = $_FILES['image']['name'];
   $image_type = $_FILES['image']['type'];
   $image_size = $_FILES['image']['size'];
   
   $ok = true;
   
   //A series of input verification
    if (empty($location)) {
        $_SESSION['login_err'][0] = "Please provide your location!";
        $ok = false;
        header('location:join.php');
    }
    if (empty($social_url)) {
        $_SESSION['login_err'][1] = "Please provide your social url!";
        $ok = false;
        header('location:join.php');
    }
    if(empty($skill)){
        $_SESSION['login_err'][2] = "Please provide your skills!";
        $ok = false;
        header('location:join.php');
    }
    if(empty($image_name)){
        $_SESSION['login_err'][3] = "Please upload your profile picture!  ";
        $ok = false;
        header('location:join.php');
    }
    
//File Validation and Upload Process
    $target_dir = "profile_pics/";
    $target_file = $target_dir . $image_name;

      if(getimagesize($_FILES['image']['tmp_name']) != 0) {          
        $ok = true;
      } else if(!empty($image_type)){
        $_SESSION['login_err'][4] =  "File is not an image.  ";
        $ok = false;
        header('location:join.php');
      }


    if(!empty($image_type) && $image_type != "image/jpg" && $image_type != "image/png" && $image_type != "image/jpeg"
    && $image_type != "image/gif" ) {
      $_SESSION['login_err'][7] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.  " . $image_type;
      $ok = false;
      header('location:join.php');
    }

    if ($ok == false) {
        $_SESSION['login_err'][8] = "Sorry, your file was not uploaded.  ";
    } else if (move_uploaded_file($image_tmp, $target_file)) {
        header('location:success_msg.php');
    } else {
        $_SESSION['login_err'][9] = "Sorry, there was an error uploading your file.  ". print_r($_FILES);
        $ok = false;
        header('location:join.php');
    }
   


//Database process
   if($ok === true){
   if(!isset($_SESSION['isJoin'])){
        try{
            require_once('connect.php');
            $query = "INSERT INTO user_info_more (id, location, social_media_URL, skill, image_id) VALUES (:id, :location, :social_url, :skill, :image);";
            $statement = $db->prepare($query);
            $id = $_SESSION['id'];
            $statement->bindValue(':id', $id);
            $statement->bindValue(':location', $location);
            $statement->bindValue(':social_url', $social_url);
            $statement->bindValue(':skill', $skill);
            $statement->bindValue(':image', $image_name);
            $statement->execute();
            $statement->closeCursor();
        }catch(PDOException $e){
            echo "$e->getMessage()";
        }
    $_SESSION['newJoin'] = 1;
    $_SESSION['isJoin'] = 1;
   }else{
        try{
        require_once('connect.php');
        $query = "UPDATE user_info_more SET id = :id, location = :location, social_media_URL = :social_url, skill = :skill, image_id = :image WHERE id = :id;";
        $statement = $db->prepare($query);
        $id = $_SESSION['id'];
        $statement->bindValue(':id', $id);
        $statement->bindValue(':location', $location);
        $statement->bindValue(':social_url', $social_url);
        $statement->bindValue(':skill', $skill);
        $statement->bindValue(':image', $image_name);
        $statement->execute();
        $statement->closeCursor();
        }catch(PDOException $e){
            echo "$e->getMessage()";
        }
        $_SESSION['isPersonalInfoUpdate'] = 1;
        unset($_SESSION['newJoin']);
        $_SESSION['isJoin'] = 1;
   }
    
    header('location: success_msg.php');
   }
?>

