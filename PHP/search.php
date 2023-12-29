<html lang="en">
<head>
  <title>Word on the Street</title>
  <link rel="stylesheet" href="../CSS/pages.css"/>
</head>

  <header>
  <figure>
    <a href="home.php"><img src="../Images/logo.png" alt="logo" width="200" height="100" id="logo"/></a>
  </figure>
  <span>
    <form action="search.php" method="post">
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
     if(isset($_SESSION["loggedIn"])){
       $user = $_SESSION["loggedIn"];
       if($_SESSION["isAdmin"] == "Admin"){
         echo "  <span><a href = admin/login.php><p>$user</p></a> </span>";  
       }else{
         echo "  <span><a href = login/account/account.php><p>$user</p></a> </span>";
       }$_SESSION["fail"] = null;
     }else {
       echo "  <span><a href = login/login.php><p>Login</p></a> </span>";
     }
  ?>

  </header> 
  <hr>
  <body>
  <article id="center2">
  <div class="background-content">
    <h2>Search results for: <?php echo $_POST["search"]; ?></h2>
    <?php
      
  
        $DATABASE_HOST = 'localhost';
        $DATABASE_USER = '83150367';
        $DATABASE_PASS = 'rootpw';
        $DATABASE_NAME = 'db_83150367';
        $temp = '';
        try {
            $pdo = new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
            echo '<p></p>';
        } catch (PDOException $exception) {
            // If there is an error with the connection, stop the script and display the error
            exit('Failed to connect to database!');
        }
        try{
        $searched = $_POST["search"];
        $temp = $searched;
        $searched = '%'.$searched.'%';
        
        $sql = "SELECT * FROM comments WHERE content LIKE '$searched' or title LIKE '$searched' or display_name LIKE '$searched'";
        $result = $pdo -> query($sql);
        $count = 0;
        while($row = $result->fetch()){
            $curr = $row['display_name'];
            $cont = $row['content'];
            $title = $row['title'];
         
            echo "<div><h1> $title</h1><p>$cont</p><p>By: $curr</p></div><hr>";
            $count +=1;
          
        }
      
      if($count==0){
          echo "No results found for: $temp";
        }
      else{
          echo "$count results found for: $temp";
        }   
      }catch(Exception $e){
        echo $e;
      }
    ?>
    <!-- <a href="#"><p class="news">New Features</p></a> 
    <a href="#"><p class="news">Community Guidelines</p></a> 
    <a href="#"><p class="news">About</p></a>  -->
  </div>

 
</body>
</html>