
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
    <a href="#"><p>My Posts</p></a> 
  </span>
  <span>
    <a href="../News/news.php"><p>News</p></a> 
  </span>
  <span>
    <a href="../forums/forums.php"><p>Forums</p></a> 
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
    <h2>My Posts</h2>
    <?php
      
      if(isset($_SESSION['loggedIn'])){
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = '83150367';
        $DATABASE_PASS = 'rootpw';
        $DATABASE_NAME = 'db_83150367';
        $username = $_SESSION["loggedIn"];
        echo "<h1>Hello $username, here are you previous posts: </h1>";
        try {
            $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
            echo '<p></p>';
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error
            exit('Failed to connect to database!');
        }
        $sql = "SELECT * FROM comments JOIN pages ON comments.page_ID = pages.pageID LEFT JOIN commentimg ON comments.id = commentimg.postID";
        $result = $pdo -> query($sql);
        while($row = $result->fetch()){
          $curr = $row['acc_id'];
          $cont = $row['content'];
          $title = $row['title'];
          $link = $row['link'];
          $likes = $row['votes'];
          
          if($curr == $_SESSION['id']){
            echo "<div class = 'OP'>";
            echo "<h1><a href = '../$link'>$title</a></h1><p>$cont</p>";
            if(!empty($row['img'])){
              echo "<p>Post has an image</p>";
            }
            echo "<p>Like count: $likes </p>";
            echo "</div><hr>";
          }
        }
      }else{
        echo "<h1>Please log in to see your posts</h1>";
      }
    ?>
    <!-- <a href="#"><p class="news">New Features</p></a> 
    <a href="#"><p class="news">Community Guidelines</p></a> 
    <a href="#"><p class="news">About</p></a>  -->
  </div>

 
</body>
</html>