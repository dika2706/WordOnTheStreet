<?php
    session_start();
    $link = $_POST["imgLink"];
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = '83150367';
    $DATABASE_PASS = 'rootpw';
    $DATABASE_NAME = 'db_83150367';
    $user = $_SESSION["id"];
    try {
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        echo '<p></p>';
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error
        exit('Failed to connect to database!');
    }

    try{
    $SQL = "UPDATE account SET imgPath = ? WHERE id = ?";
    $statement = $pdo->prepare($SQL);
    $statement -> execute([$link, $user]);
    $pdo = null;
    $_SESSION["img"] = $link;
    echo "<script>window.location.href='account.php';</script>";
    }catch (Exception $e){
        $pdo = null;
        echo "<script>alert('Error');</script>";
        echo "<script>window.location.href='account.php';</script>";
    }
?>