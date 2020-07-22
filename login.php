<?php
    session_start();
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
      <form action="login_process.php" method="post">
        <label for="account"> Account </label>
        <input type="text" name="account" class="form-control" id="account">
        <label for="password"> Password </label>
        <input type="password" name="password" class="form-control" id="password">
        <input type="checkbox" onclick="show()" id="show_pwd">
        <lable for="show_pwd">Show Password</label>
            <script language='javascript'>
                function show() {
                  var x = document.getElementById("password");
                  if (x.type === "password") {
                    x.type = "text";
                  } else {
                    x.type = "password";
                  }
                }
            </script>
        <input type="submit" name="submit" value="Login" class="form-login">
      </form>
        <nav>
            <ul>
                <li>Not a Member? Let's <a href="register.php">Register</a></li>
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