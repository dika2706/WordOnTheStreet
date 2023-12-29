<?php
    $username = $_GET["username"];
    $email = $_GET["email"];
    $pass = $_GET["password"];
    $pass2 = $_GET["retype"];
    if($pass!=$pass2){
        echo "<script>alert('Password Mismatch. Please try again.');window.location.href='create-account.php';</script>";
    }else if(strlen($pass) < 5){
        echo "<script>alert('Password too short. Please try again.');window.location.href='create-account.php';</script>";
    }else{
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
    $SQL = "INSERT INTO account(user, password, displayName, auth) VALUES (?, ?, ?, 'Member')";
    $statement = $pdo->prepare($SQL);
    $statement -> execute([$email, md5($pass), $username]);
    $pdo = null;
    echo "<script>window.location.href='login.php';</script>";
    }catch (Exception $e){
        $pdo = null;
        echo "<script>alert('Username or e-mail exists, please choose a new one');</script>";
        echo "<script>window.location.href='create-account.php';</script>";
    }
}
?>
