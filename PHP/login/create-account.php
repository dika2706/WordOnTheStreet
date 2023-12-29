<!DOCTYPE html>
<html>
  <head>
    <title>Create Account</title>
    <link rel="stylesheet" href="../../CSS/login.css"/>
  </head>
  <body>
    <form action="create-data.php" method="get">
      <h2>Create Account</h2>
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="retype">Retype Password:</label>
      <input type="password" id="retype" name="retype" required>
      
      <input type="submit" value="Create Account">
    </form>
    <form action="login.php">
        <input id = "backHome" type="submit" value="Back to login" />
     </form>
  </body>
</html>
