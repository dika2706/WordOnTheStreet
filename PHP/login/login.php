<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="../../CSS/login.css"/>
  </head>
  <body>
    <form action="login-data.php" method="post">
      <h2>Login</h2>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      
      <span><a href="recover.php"><p>Forgot Password</p></a></span>
      <span><a href="create-account.php"><p>Create Account</p></a></span>
      <input id = "submit" type="submit" value="Login">
      </form>
      
     <form action="../home.php">
        <input id = "backHome" type="submit" value="Back to home" />
     </form>
    

  </body>
</html>
