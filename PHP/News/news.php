
<html lang="en">
<head>
  <title>Word on the Street</title>
  <link rel="stylesheet" href="../../CSS/news.css"/>
</head>

  <header>
  <figure>
    <a href="../home.php"><img src="../../images/logo.png" alt="logo" width="200" height="100" id="logo"/></a>
  </figure>
  <span class = "head">
    <form action="../search.php" method="post">
      <input type="text" placeholder="Search" name="search" class="icon"/>
    </form>
  </span>
  <span class = "head">
    <a href="../myPosts/myPosts.php"><p>My Posts</p></a> 
  </span>
  <span class = "head">
    <a href="#"><p>News</p></a> 
  </span>
  <span class = "head">
    <a href="../forums/forums.php"><p>Forums</p></a> 
  </span >
  <?php
    session_start();
    if(isset($_SESSION["loggedIn"])){
      $user = $_SESSION["loggedIn"];
      if($_SESSION["isAdmin"] == "Admin"){
        echo "  <span class = 'head'><a href = ../admin/login.php><p>$user</p></a> </span>";  
      }else{
        echo "  <span  class = 'head'><a href = ../login/account/account.php><p>$user</p></a> </span>";
      }$_SESSION["fail"] = null;
    }else {
      echo "  <span  class = 'head'><a href = ../login/login.php><p>Login</p></a> </span>";
    }
  ?>

  </header> 
  <hr>
  <body>
  <article id="center">
  <div class="background-content">
    <h2>News</h2>
    
    <!-- <a href="#"><p class="news">New Features</p></a> 
    <a href="#"><p class="news">Community Guidelines</p></a> 
    <a href="#"><p class="news">About</p></a>  -->
    
  </div>
  <span>
  <h3 class = "node"> 
    Community Updates
  </h3>
  <!-- select and only print from CU -->
<?php
 $DATABASE_HOST = 'localhost';
  $DATABASE_USER = '83150367';
  $DATABASE_PASS = 'rootpw';
  $DATABASE_NAME = 'db_83150367';

  try {
      $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
  } catch (PDOException $exception) {
      // If there is an error with the connection, stop the script and display the error
      exit('Failed to connect to database!');
  }
  try{
  $sql = "SELECT * FROM news WHERE type = 'CU' ORDER BY time DESC";
  $result = $pdo -> query($sql);
  echo "<div class = 'devPost'>";
  while($row = $result ->fetch()){
    // print
    $title = $row['title'];
    $content = $row['content'];
    $postedOn = $row['time'];
    $html = "
    <h3>$title</h3>
    <p datetime = $postedOn class = 'time'>Posted on: $postedOn</p>
    <p>$content</p>
    <hr>
    ";
    echo $html;
  }
  echo "</div>";

 }
  catch(Exception $e){
      echo $e;
      $pdo=null;
      //echo "<script>window.location.href='index.php';</script>";
  }
?>
    <!-- display three latest updates -->

  <h3 class = "node"> 
    General News
  </h3>
  <?php
 $DATABASE_HOST = 'localhost';
  $DATABASE_USER = '83150367';
  $DATABASE_PASS = 'rootpw';
  $DATABASE_NAME = 'db_83150367';

  try {
      $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
  } catch (PDOException $exception) {
      // If there is an error with the connection, stop the script and display the error
      exit('Failed to connect to database!');
  }
  try{
  $sql = "SELECT * FROM news WHERE type = 'GN' ORDER BY time DESC";
  $result = $pdo -> query($sql);
  echo "<div class = 'devPost'>";
  while($row = $result ->fetch()){
    // print
    $title = $row['title'];
    $content = $row['content'];
    $postedOn = $row['time'];
    $html = "
    <h3>$title</h3>
    <p datetime = $postedOn class = 'time'>Posted on: $postedOn</p>
    <p>$content</p>
    <hr>
    ";
    echo $html;
  }
  echo "</div>";

 }
  catch(Exception $e){
      echo $e;
      $pdo=null;
      //echo "<script>window.location.href='index.php';</script>";
  }
?>
<!-- display three latest general news -->
  </span>
</body>
</html>