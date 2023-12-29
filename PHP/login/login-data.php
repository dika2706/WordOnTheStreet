<?php

// check contents with SQL
//examine email to email
//if email match with email see if password correct, if not send back to login page 
//if no email found send to create new account
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

$emails = $_POST["email"];
$pass = md5($_POST["password"]);
echo "$emails and $pass";
$sql = "SELECT * FROM account";

$result = $pdo -> query($sql);
echo '<p></p>';
while ($row = $result->fetch()) {
    // the keys match the field names from the table
    $curr = $row['user'];
    if($curr == $emails){
        if($row['banned'] == "banned"){
            echo "<script>alert('Banned, unable to login'); window.location.href='login.php';</script>";
            exit();
        }
        if($row['password'] == $pass){
            session_start();
            
            $_SESSION["fail"] = null;
            $_SESSION["loggedIn"] = $row['displayName'];
            $_SESSION["isAdmin"] = $row['auth'];
            $_SESSION["id"] = $row['id'];
            $_SESSION["img"] = $row['imgPath'];
            $_SESSION["pw"] = $row['password'];
            $_SESSION['banStat'] = $row['banned'];
            $pdo = null;
            $_SESSION['comment_account_loggedin'] = TRUE;
            $_SESSION['comment_account_id'] = $_SESSION['id'];
            $_SESSION['comment_account_display_name'] = $account['display_name'];
            $_SESSION['comment_account_role'] = $account['role'];
            header("Location: ../home.php");
            die();
        }else{
            $pdo = null;
            echo "<script>alert('wrong login info'); window.location.href='login.php';</script>";
            
        }
    }else{
        
    }
    
    }
    $pdo = null;
    echo "<script>alert('wrong login info'); window.location.href='login.php';</script>";

?>

