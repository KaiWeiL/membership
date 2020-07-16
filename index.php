<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php 
    $id = filter_input(INPUT_GET, 'id');
    $fname = null;
    $lname = null;
    $email = null;
    $city = null;
    $skills = null;
    if(!empty($id)){
        try{
        require_once('connect.php');
        $sql = 'SELECT * FROM developer_info WHERE id = :id';
        $statement = $db->prepare($sql);
        $statement->bindValue('id', $id);
        $statement->execute();
        $record = $statement->fetch();
        
        $fname = $record['first_name'];
        $lname = $record['last_name'];
        $email = $record['email'];
        $city = $record['current_city'];
        $skills = $record['skills'];
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Developer Network</title>
    </head>
    
        <form action="process.php" method="post">   
            <h1>Join the Network</h1>
            <h2>Have a connection with thousands of developers</h2>
            <label for="fname">First Name </lable>
            <input type="text" name="fname" class="item fname" id="fname" value="<?php echo $fname; ?>">
            <label for="lname">Last Name </lable>
            <input type="text" name="lname" class="item lname" id="lname" value="<?php echo $lname; ?>">
            <lable for="email">Email </lable>
            <input type="email" name="email" class="item email" id="email" value="<?php echo $email; ?>"> <!-- check the validity of email address -->
            <label for="city"> City </label>
            <input type="text" name="city" class="item city" id="city" value="<?php echo $city; ?>">
            <p>What are your skills?</p>
            <textarea name="skills" class="item skills" id="skills" maxlength="80" value="<?php echo $skills; ?>"></textarea> <!-- Set the front-end character length checker for overflow -->
            <input type="submit" name="submit" class="submit" id="submit" value="Submit">
            
            <p><a href="review.html">Project Review</a></p>
        </form>
    

