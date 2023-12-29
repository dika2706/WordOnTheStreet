<?php
session_start();
// Include the config file
include_once '../config.php';
// Connect to the MySQL database
try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}
// Output message
$msg = '';
// Capture form data and authenticate the user
if (isset($_POST['admin_email'], $_POST['admin_password'])) {
    // Check if account exists with the captured email
    $stmt = $pdo->prepare('SELECT * FROM account WHERE auth = "Admin" AND user = ?');
    $stmt->execute([ $_POST['admin_email'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    if($account == FALSE){
        echo "<script>alert('Not an admin'); window.location.href='../home.php';</script>";
    }else{
   
    }
    // Verify password if account exists
    if (($account['password']) == md5($_POST['admin_password']) && $_POST['admin_email'] == $account['user'] && $account['auth'] == 'Admin') {
        // Authenticate the user
        $_SESSION['comment_account_loggedin'] = TRUE;
        $_SESSION['comment_account_id'] = $account['id'];
        $_SESSION['comment_account_display_name'] = $account['display_name'];
        $_SESSION['comment_account_role'] = $account['role'];
        // Redirect to dashboard page
        header('Location: index.php');
        exit;
    } else {
        $msg = 'Incorrect email and/or password!';
    }
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Login</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,minimum-scale=1">
        <link href="admin.css" rel="stylesheet" type="text/css">
	</head>
	<body class="login">
        <div id = "sample">
         <h1>Please Re-login to confirm Admin status</h1>
        </div>
        <form action="" method="post" class="">
            <input type="email" name="admin_email" placeholder="Email" required>
            <input type="password" name="admin_password" placeholder="Password" required>
            <input type="submit" value="Login">
            <p><?=$msg?></p>
        </form>
    </body>
    <form action="../home.php" style = "margin-top: -8.5em">
        <input id = "backHome" type="submit" value="Back to home" />
     </form>
     <form action="../login/account/logout.php" style = "margin-top: -6.5em">
        <input id = "backHome" type="submit" value="logout" />
     </form>
</html>