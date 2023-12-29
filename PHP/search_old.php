<?php
    $searched = $_POST["search"];
    echo $searched;
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = '83150367';
    $DATABASE_PASS = 'rootpw';
    $DATABASE_NAME = 'db_83150367';
    try {
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        echo '<p></p>';
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error
        exit('Failed to connect to database!');
    }
    $sql = "SELECT * FROM comments";
    $result = $pdo -> query($sql);
    while($row = $result->fetch()){
          $curr = $row['display_name'];
          $cont = $row['content'];
          $title = $row['title'];
          
          if(strtolower($curr) == strtolower($searched)){
            echo "<h1>Title of Post: $title</h1><p>$cont</p><p>By: $curr</p>";
          }
    }

    $pdo = null;
?>