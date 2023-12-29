<?php
    $radioRes = $_POST["newsType"];
    $title = $_POST["title"];
    $content = $_POST["cont"];
    
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
    try{
    $sql = "INSERT INTO news(title, content, type) VALUES (?, ?, ?)";
    $statement = $pdo->prepare($sql);
    $statement -> execute([$title, $content, $radioRes]);
    $pdo = null;
    echo "<script>window.location.href='../News/news.php';</script>";
    }
    catch(Exception $e){
        echo $e;
        $pdo=null;
        echo "<script>window.location.href='index.php';</script>";
    }
?>