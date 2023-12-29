<?php
    session_start();
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = '83150367';
    $DATABASE_PASS = 'rootpw';
    $DATABASE_NAME = 'db_83150367';
    $user = $_SESSION['id'];
    $realPass = $_SESSION["pw"];
    $currPass = $_POST["curr"];
    $newPass = $_POST["new"];
    $vNew = $_POST["vNew"];
    
    if($vNew != $newPass){
        echo "<script>alert('Make sure your new password matches');</script>";
        echo "<script>window.location.href='account.php';</script>";
        die();
    }

    if($realPass != $currPass){
        echo "<script>alert('Wrong password');</script>";
        echo "<script>window.location.href='account.php';</script>";
        die();
    }

    $pass = $_SESSION["password"];
    try {
        $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
        echo '<p></p>';
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error
        exit('Failed to connect to database!');
    }

    try{
    
    $SQL = "UPDATE account SET password = ? WHERE id = ?";
    $statement = $pdo->prepare($SQL);
    $statement -> execute([md5($newPass), $user]);
    $pdo = null;
    $_SESSION['pw'] = $newPass;
    echo "<script>window.location.href='account.php';</script>";
    }catch (Exception $e){
        $pdo = null;
        echo "<script>alert('Error');</script>";
        echo "<script>window.location.href='account.php';</script>";
    }
?>