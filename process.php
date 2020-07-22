
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>COMP1006 - Week 4 - Let's Connect </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Piedra&family=Quicksand&display=swap" rel="stylesheet">
    <!-- Compiled and minified JavaScript -->
    <link href="main.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
    <header>
      <h1> TuneShare - Share Your Fave Tunes & Join The Community </h1>
    </header>
    <main>
        <?php

//create variables to store form data
$first_name = filter_input(INPUT_POST, 'fname');
$last_name = filter_input(INPUT_POST, 'lname');
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

//set up a flag variable

$ok = true;


//validate
// first name and last name not empty

if (empty($first_name) || empty($last_name)) {
    echo "<p class='error'>Please provide both first and last name! </p>";
    $ok = false;
}

//email not empty and proper format
if (empty($email) || $email === false) {
    echo "<p class='error'>Please include your email in the proper format!</p>";
    $ok = false;
}


//if form validates, try to connect to database and add info

if ($ok === true) {
    try {

        // add a comment to explain the line of code below
        // check whether the php script file has been included and if not include the php script file. If so, it won't include it again.
        require_once('connect.php');

        // add a comment to explain the line of code below
        // create the SQL query and then store it in the php variable
        $sql = "INSERT INTO user_info (first_name, last_name, email) VALUES (:firstname, :lastname, :email);"; // what is missing here?

        // add a comment to explain the line of code below
        // prepare the specified SQL statement for execution and assign a returned PDOStatement to php variable
        $statement = $db->prepare($sql); // fill in the correct method

        // add a comment to explain the line of code below
        // bind the php varaibles to the "named parameters"(textbook p.130 uses this term) :)
        $statement->bindParam(':firstname', $first_name);
        $statement->bindParam(':lastname', $last_name);
        $statement->bindParam(':email', $email);

        // add a comment to explain the line of code below
        // execute the prepared statement
        $statement->execute(); // fill in the correct method

        // show message
        echo "<p> Song added! Thanks for sharing! </p>";

        // add a comment to explain the line of code below
        // close the connection to the database
       $statement -> closeCursor(); // fill in the correct method


    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        //show error message to user
        echo "<p> Sorry! We weren't able to process your submission at this time. We've alerted our admins and will let you know when things are fixed! </p> ";
        echo $error_message;
        //email app admin with error
        mail('youremailhere@gmail.com', 'App Error ', 'Error :'. $error_message);
    }
}
?>
    <a href="index.php" class="error-btn"> Back to Form </a>
    </main>
    <footer>
      <p> &copy; 2020 Lab Nine </p>
    </footer>
   </div><!--end container-->
  </body>
</html>
