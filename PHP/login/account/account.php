<html>
<?php
session_start();
if(!isset($_SESSION["loggedIn"])){
    echo "window.location.href='login.php'";
} ?>
<head>
  <title>Word on the Street</title>
  <link rel="stylesheet" href="../../../CSS/dash.css"/>
</head>
  <header>
  <figure>
    <a href="../../home.php"><img src="../../../images/logo.png" alt="logo" width="200" height="100" id="logo"/></a>
  </figure>
  <span>
    <form action="../../search.php" method="post">
      <input type="text" placeholder="Search" name="search" class="icon"/>
    </form>
  </span>
  <span>
    <a href="../../myPosts/myPosts.php"><p>My Posts</p></a> 
  </span>
  <span>
    <a href="../../News/news.php"><p>News</p></a> 
  </span>
  <span>
    <a href="../../forums/forums.php"><p>Forums</p></a> 
  </span>
  
  <?php
    if(isset($_SESSION["loggedIn"])){
      $user = $_SESSION["loggedIn"];
      if($_SESSION["isAdmin"] == "Admin"){
        echo "  <span><a href = ../../admin/login.php><p>$user</p></a> </span>";  
      }else{
        echo "  <span><a href = #><p>$user</p></a> </span>";
      }$_SESSION["fail"] = null;
    }else {
      echo "  <span><a href = ../login/login.php><p>Login</p></a> </span>";
    }
    
  ?>
   

  </header> 
  <body>
  <hr>
  <div id="main">
  <article id="left-sidebar">
    <h3>Feed</h3>
    <a href="../../home.php" class="link"><p>Home</p></a>
    <h3>Forums</h3>
    <a href="../../games.php" class="link"><p>Games</p></a>
    <a href="../../movies-tv.php" class="link"><p>Movies & TV</p></a>
    <a href="../../ent.php" class="link"><p>Entertainment</p></a>
    <a href="../../tech.php" class="link"><p>Technology</p></a>
    <a href="../../sports.php" class="link"><p>Sports</p></a>
    <a href="../../coding.php" class="link"><p>Coding</p></a>
  </article>
  
    
  <div id="center">
  <h1 style = "text-align: center;"> Welcome to your dashboard! </h1>
    <div class = "sect">
      
  <h2>Change your profile picture</h2>
  <h3>Your current photo: </h3>
    <?php
    $currentPhoto = $_SESSION["img"];
    echo "<img src = '$currentPhoto' class = 'profPic'/>";
    ?>
    <form action = "profPic.php" method = "POST">
        <label>Insert image link: </label>
        <input type = "text" name = "imgLink"> </input> </br>
        <input type = "submit"></br>
    </form>
</div>
<div class = "sect">
      
  <h2>Change your password</h2>
    <form action = "newPass.php" method = "POST">
        <label>Current password: </label></br>
        <input type = "text" name = "curr"> </input> </br>
        <label>New password: </label></br>
        <input type = "text" name = "new"> </input> </br>
        <label>Verify new password: </label></br>
        <input type = "text" name = "vNew"> </input> </br>
</br>
        <input type = "submit">
    </form>
</div>
    <div class = "sect">
    <a href = "logout.php" class = "logoutButton">Logout</a>
</div>
</div>


</html>