<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "83150367";
$password = "rootpw";
$dbname = "db_83150367";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for errors in the database connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the email address and password from the form submission
$email = $_POST["email"];

// Generate a random string for the email subject and body
$subject = "Hello from my website!";
$body = "This is a test email from my website.";

// Retrieve the password from the database
$sql = "SELECT password FROM account WHERE user = '$email'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$retrieved_pass = $row["password"];

$html = "
<html>
    <form name = 'ff' action = 'mailto:$email' method = 'post'>
    <input type = 'text' value = '$retrieved_pass'>
    <input type = 'submit'>
</html>
<script>
window.onload = function(){
    document.forms['ff'].submit();
  }
</script>
";


echo $html;



// Close the database connection
$conn->close();

// End the script
exit;
?>
