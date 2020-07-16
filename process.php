<?php

   $fname = filter_input(INPUT_POST, 'fname');
   $lname = filter_input(INPUT_POST, 'lname');
   $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
   $city = filter_input(INPUT_POST, 'city');
   $skills = filter_input(INPUT_POST, 'skills');

?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Developer Network</title>
    </head>
    <body>
        <?php 
             // A series of checkers checks whether the required fields are empty and whether the email format is correct
             $ok = true;

            if (empty($fname)) {
                echo "<p>First name cannot be empty</p>";
                $ok = false;
            }
            if (empty($lname)) {
                echo "<p>Last name cannot be empty</p>";
                $ok = false;
            }
            if (empty($email) && $email != false) {
                echo "<p>Email cannot be empty</p>";
                $ok = false;
            }
            if ($email === false) {
                echo "<p>Please include your email in the proper format!</p>";
                $ok = false;
            }
            
            if($ok === false){
                echo "<a href=\"index.php\" class=\"button\"> Return </a>";
            }
            
            if ($ok === true){
            
                try{
                    require_once('connect.php');
                    $query = "INSERT INTO developer_info (first_name, last_name, email, current_city, skills) VALUES (:fname, :lname, :email, :city, :skills);";
                    $statement = $db->prepare($query);
                    $statement->bindValue(':fname', $fname);
                    $statement->bindValue(':lname', $lname);
                    $statement->bindValue(':email', $email);
                    $statement->bindValue(':city', $city);
                    $statement->bindValue(':skills', $skills);
                    $statement->execute();
                    $statement->closeCursor();
                    
                    echo "Submit Success!";
                    echo "<a href=\"view.php\">View and Edit</a>";
                }catch(PDOException $e){
                    echo "$e->getMessage();";
                }
            }
        ?>
    </body>
</html>




