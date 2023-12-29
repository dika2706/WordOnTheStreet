<html lang="en">
<head>
  <title>Word on the Street</title>
  <link rel="stylesheet" href="../CSS/page.css"/>
</head>

  <header>
  <figure>
    <a href="home.php"><img src="../images/logo.png" alt="logo" width="200" height="100" id="logo"/></a>
  </figure>
  <span>
    <form action="search.php" method="POST">
      <input type="text" placeholder="Search" name="search" class="icon"/>
    </form>
  </span>
  <span>
    <a href="myPosts/myPosts.php"><p>My Posts</p></a> 
  </span>
  <span>
    <a href="News/news.php"><p>News</p></a> 
  </span>
  <span>
    <a href="forums/forums.php"><p>Forums</p></a> 
  </span>
  <?php
    session_start();
    if(!(isset($_SESSION["loggedIn"]))){
      echo '<span> <a href="login/login.php"><p>Login</p></a> </span>';
    }else{
      $user = $_SESSION["loggedIn"];
      if($_SESSION["isAdmin"] == "Admin"){
        echo "  <span><a href = admin/login.php><p>$user</p></a> </span>";  
      }else{
        echo "  <span><a href = login/account/account.php><p>$user</p></a> </span>";
      }$_SESSION["fail"] = null;
    }
  ?>

   

  </header> 
  <body>
  <hr>
  <div id="main">
  <article id="left-sidebar">
  <h3>Feed</h3>
    <a href="home.php" class="link"><p>Home</p></a>
    <h3>Forums</h3>
    <a href="games.php" class="link"><p>Games</p></a>
    <a href="movies-tv.php" class="link"><p>Movies & TV</p></a>
    <a href="ent.php" class="link"><p>Entertainment</p></a>
    <a href="tech.php" class="link"><p>Technology</p></a>
    <a href="sports.php" class="link"><p>Sports</p></a>
    <a href="coding.php" class="link"><p>Coding</p></a>
  </article>
  <article id="center">
  <div class="background-content">
    <h2>New Additions to Website</h2>
    <a href="News/news.php"><p class="news">New Features</p></a> 
    <a href="News/news.php"><p class="news">Community Guidelines</p></a> 
    <a href="#footer"><p class="news">About</p></a> 
  </div>
  <div class="posts">
    <!-- <div class="page-title">
      <h2>Trending Posts</h2>
      <hr>
    </div> -->

    <?php
      
      
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
        $sql = "SELECT * FROM comments JOIN pages ON comments.page_id = pages.pageID  WHERE parent_id = -1 ORDER BY votes DESC LIMIT 5";
        $result = $pdo -> query($sql);
        while($row = $result->fetch()){
          $curr = $row['acc_id'];
          $cont = $row['content'];
          $title = $row['title'];
          $link = $row['link'];
            echo "<div class = 'contenthome'><h1>$title</h1><p>$cont</p><a href = $link>Click here to visit the forum page</a></div>";
          
        }
      $pdo =  null;
    ?>
  </div>
</article>
<article id="right-sidebar">
  <h3>Trending Topics</h3>
  <?php
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
    $sql = "SELECT page_id, pages.pageName, pages.link, COUNT(*) as numCount FROM comments JOIN pages ON comments.page_id = pages.pageID GROUP BY page_id ORDER BY numCount desc LIMIT 5;";
    $result = $pdo -> query($sql);
    
        while($row = $result->fetch()){
          $link = $row['link'];
          $pName = $row['pageName'];
          echo '<div class = "Trending">';
          echo "<p><a href = '$link'>$pName</a></p>";
          echo '</div>';
        }
      $pdo = null;

  ?>
</article>
</div>
<footer id = "footer">
    <p>
    Word on the Street is a vibrant online community where diverse voices come together to share their thoughts and 
    opinions. From breaking news to pop culture, our forum is the go-to destination for engaging discussions and meaningful 
    interactions. Join the conversation and make your voice heard on Word on the Street today.
  </p>
</footer>
</body>
</html>