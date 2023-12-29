<!DOCTYPE html>
<html lang="en">
<head>
  <title>Word on the Street</title>
  <link rel="stylesheet" href="../../CSS/forums.css"/>
</head>

  <header>
  <figure>
    <a href="../home.php"><img src="../../images/logo.png" alt="logo" width="200" height="100" id="logo"/></a>
  </figure>
  <span>
    <form action="../search.php" method="post">
      <input type="text" placeholder="Search" name="search" class="icon"/>
    </form>
  </span>
  <span>
    <a href="../myPosts/myPosts.php"><p>My Posts</p></a> 
  </span>
  <span>
    <a href="../News/news.php"><p>News</p></a> 
  </span>
  <span>
    <a href="#"><p>Forums</p></a> 
  </span>
  <?php
    session_start();
    if(isset($_SESSION["loggedIn"])){
      $user = $_SESSION["loggedIn"];
      if($_SESSION["isAdmin"] == "Admin"){
        echo "  <span><a href = ../admin/login.php><p>$user</p></a> </span>";  
      }else{
        echo "  <span><a href = ../login/account/account.php><p>$user</p></a> </span>";
      }$_SESSION["fail"] = null;
    }else {
      echo "  <span><a href = ../login/login.php><p>Login</p></a> </span>";
    }
  ?>

  </header> 
  <hr>
  <body>
  <article id="center">
  <div class="background-content">
    <h2>Find a forum</h2>
    
    <!-- <a href="#"><p class="news">New Features</p></a> 
    <a href="#"><p class="news">Community Guidelines</p></a> 
    <a href="#"><p class="news">About</p></a>  -->
    <p class="listed"><a href="../games.php">Games</a></p>
    <a href="../movies-tv.php"><p  class="listed">Movies & TV</p></a>
    <a href="../ent.php"><p  class="listed">Entertainment</p></a>
    <a href="../tech.php"><p  class="listed">Technology</p></a>
    <a href="../sports.php"><p  class="listed">Sports</p></a>
    <a href="../coding.php"><p  class="listed">Coding</p></a>
  </div>

 
</body>
</html>