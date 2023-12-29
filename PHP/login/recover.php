<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../../CSS/login.css"/>
  </head>
  <body>
    <form action="submit.php" method="post">
      <h2>Recover Account</h2>
      <p>Enter the email for the account</p>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <input type="submit" value="Recover Account"> 
    </form>
    <form action="login.php">
      <input id = "backHome" type="submit" value="Back to login" />
   </form>
  </body>
</html>