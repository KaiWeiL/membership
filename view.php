<!DOCTYPE html>
<html>
  <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
        <title>Developer Network</title>
  </head>
  <body>
    <header>
      <h1> Your Information </h1>
    </header>
    <main>
        <?php

        require_once('connect.php');
        $sql = 'SELECT * FROM developer_info';
        $statement = $db->prepare($sql);
        $statement->execute();
        $record = $statement->fetchAll();
        foreach ($record as $records){ ?>
        <tr>
            <td><?php echo $records['first_name']; ?></td>
            <td><?php echo $records['last_name']; ?></td>
            <td><?php echo $records['email']; ?></td>
            <td><?php echo $records['current_city']; ?></td>
            <td><?php echo $records['skills']; ?></td>
            <?php $hrefDelete='delete.php?id='.$records['id'] ?>
            <a href="<?php echo $hrefDelete ?>"> Delete </a>
            <?php $hrefUpdate='index.php?id='.$records['id'] ?>
            <a href="<?php echo $hrefUpdate ?>"> Update </a>
        </tr>

        <?php
        }
            $statement->closeCursor();
        ?>
    </main>
  </body>
</html>