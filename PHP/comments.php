<?php
// Initialize sessions
session_start();
// Include the config file
include 'config.php';
//connect using mysqli
$DATABASE_HOST = 'localhost';
$DATABASE_USER = '83150367';
$DATABASE_PASS = 'rootpw';
$DATABASE_NAME = 'db_83150367';

$connection = new mysqli($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

// Check connection
if ($connection -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}

// Connect to the MySQL database using the PDO interface
try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}
// The following function will be used to assign a unique icon color to our users
function color_from_string($string) {
    // The list of hex colors
    $colors = ['#34568B','#FF6F61','#6B5B95','#88B04B','#F7CAC9','#92A8D1','#955251','#B565A7','#009B77','#DD4124','#D65076','#45B8AC','#EFC050','#5B5EA6','#9B2335','#DFCFBE','#BC243C','#C3447A','#363945','#939597','#E0B589','#926AA6','#0072B5','#E9897E','#B55A30','#4B5335','#798EA4','#00758F','#FA7A35','#6B5876','#B89B72','#282D3C','#C48A69','#A2242F','#006B54','#6A2E2A','#6C244C','#755139','#615550','#5A3E36','#264E36','#577284','#6B5B95','#944743','#00A591','#6C4F3D','#BD3D3A','#7F4145','#485167','#5A7247','#D2691E','#F7786B','#91A8D0','#4C6A92','#838487','#AD5D5D','#006E51','#9E4624'];
    // Find color based on the string
    $colorIndex = hexdec(substr(sha1($string), 0, 10)) % count($colors);
    // Return the hex color
    return $colors[$colorIndex];
}
// Below function will convert datetime to time elapsed string.
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);
    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;
    $string = array('y' => 'year', 'm' => 'month', 'w' => 'week', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second');
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }
    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
// The below function will output a comment
function show_comment($comment, $comments = [], $filters = [], $max_comments = -1, $current_nest = 0) {
    static $count = 0;
    $count++;
    if ($max_comments != -1 && $count > $max_comments) return;
    // Convert new lines to <br> and escape special characters
    $content = str_replace("\r\n\r\n", "<br><br>\r\n", htmlspecialchars($comment['content'], ENT_QUOTES));
    $title = str_replace("\r\n\r\n", "<br><br>\r\n", htmlspecialchars($comment['title'], ENT_QUOTES));
    // Allowed html tags, feel free to add tags to the arrays
    $independant_tags = ['<code>', '</code>', '<pre>', '</pre>', '<blockquote>', '</blockquote>', '<h6>', '</h6>'];
    $allowed_tags = array_merge($independant_tags, ['<i>', '</i>', '<strong>', '</strong>', '<u>', '</u>']);
    $escapted_tags = array_map(function($value) {
        return htmlspecialchars($value, ENT_QUOTES);
    }, $allowed_tags);
    $content = str_ireplace($escapted_tags, $allowed_tags, $content);
    // Apply the filters
    if ($filters) {
        $content = str_ireplace(array_column($filters, 'word'), array_column($filters, 'replacement'), $content);
    }
    // Add paragraph tags
    $arr = explode("\n", $content);
    $out = '';
    for ($i = 0; $i < count($arr); $i++) {
        if (strlen(trim($arr[$i])) > 0) {
            if (!preg_match('#^(' . implode('|', $independant_tags) . ')(.*)$#i', trim($arr[$i]))) {
                $out .= '<p>' . trim($arr[$i]) . '</p>';
            } else {
                $out .= trim($arr[$i]);
            }
        }
    }
    // Remove paragraph tags inside independant tags
    $content = preg_replace_callback('/<(code|pre|blockquote|h6)>(.*?)<\/(code|pre|blockquote|h6)>/s', function($matches) {
        return str_replace(['<p>', '</p>'], ['', '<br>'], $matches[0]);
    }, $out);
    // Comment template
    // profile picture
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
    $sqlNew = "SELECT * FROM account WHERE id = ?";
    $stmt = $pdo->prepare($sqlNew);
    $stmt->execute([$comment['acc_id']]);
    $imgRow = $stmt -> fetch();
    $pdo = null;
    //get attached image
    $sql = "SELECT contentType, img FROM commentimg where postID=?";
    $currID = $comment['id'];
    $connection = null;
    $connection = new mysqli($DATABASE_HOST,$DATABASE_USER,$DATABASE_PASS,$DATABASE_NAME);

    // Check connection
    if ($connection -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
    }

                // build the prepared statement SELECTing on the userID for the user
                $statement = mysqli_stmt_init($connection);
                //init prepared statement object
                mysqli_stmt_prepare($statement, $sql);
                // bind the query to the statement
                mysqli_stmt_bind_param($statement, "i", $currID);
                // bind in the variable data (ie userID)
                $result = mysqli_stmt_execute($statement) or die(mysqli_stmt_error($statement));
                // Run the query. run spot run!
                mysqli_stmt_bind_result($statement, $type, $image); //bind in results
                // Binds the columns in the resultset to variables
                mysqli_stmt_fetch($statement);
                // Fetches the blob and places it in the variable $image for use as well
                // as the image type (which is stored in $type)
                mysqli_stmt_close($statement);
                // release the statement
                if(!empty($type)){
                $toSHOW = '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>';
                $pdo = null;
                }
    if(!empty($type)){
    $html = '
    <div class="comment" data-id="' . $comment['id'] . '" id="comment-' . $comment['id'] . '">
        <div class="img">
        ' . (!empty($imgRow['imgPath']) ? '<img src="' . htmlspecialchars($imgRow['imgPath'], ENT_QUOTES) . '" alt="' . htmlspecialchars($comment['display_name'], ENT_QUOTES) . '\'s Profile Image">' : '<span style="background-color:' . color_from_string($comment['display_name']) . '">' . strtoupper(substr($comment['display_name'], 0, 1)) . '</span>') . '
        </div>
        <div class="con">
            <div>
                <h3 class="name">' . htmlspecialchars($comment['display_name'], ENT_QUOTES) . '</h3>
                <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
            </div>
            <div class = "attachedImg">
            ' . '<img src="data:image/'.$type.';base64,'.base64_encode($image).'"/>' . '
            </div>
            <div class="comment_content">
                <h3>'. $title .'</h3>
                ' . $content . '
                ' . ($comment['approved'] ? '' : '<br><br><i>(Awaiting approval)</i>') . '
            </div>
            <div class="comment_footer">
                <span class="num">' . number_format($comment['votes']) . '</span>
                <a href="#" class="vote" data-vote="up" data-comment-id="' . $comment['id'] . '">
                    <i class="arrow up"></i>
                </a>
                <a href="#" class="vote" data-vote="down" data-comment-id="' . $comment['id'] . '">
                    <i class="arrow down"></i>
                </a>
                <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '">Reply</a>
            
                ' . (isset($_SESSION['comment_account_loggedin']) && $_SESSION['comment_account_role'] == 'Admin' ? '<a class="edit_comment_btn" href="admin/comment.php?id=' . $comment['id'] . '" target="_blank">Edit</a>' : '') . '
            </div>
            <div class="replies">' . ($current_nest < max_nested_replies ? show_comments($comments, $filters, $max_comments, $comment['id'], $current_nest+1) : '') . '</div>
        </div>
        
    </div>
    
    ' . ($current_nest >= max_nested_replies ? show_comments($comments, $filters, $max_comments, $comment['id'], $current_nest+1) : '');
    return $html; }
    else {
        $html = '
    <div class="comment" data-id="' . $comment['id'] . '" id="comment-' . $comment['id'] . '">
        <div class="img">
        ' . (!empty($imgRow['imgPath']) ? '<img src="' . htmlspecialchars($imgRow['imgPath'], ENT_QUOTES) . '" alt="' . htmlspecialchars($comment['display_name'], ENT_QUOTES) . '\'s Profile Image">' : '<span style="background-color:' . color_from_string($comment['display_name']) . '">' . strtoupper(substr($comment['display_name'], 0, 1)) . '</span>') . '
        </div>
        <div class="con">
            <div>
                <h3 class="name">' . htmlspecialchars($comment['display_name'], ENT_QUOTES) . '</h3>
                <span class="date">' . time_elapsed_string($comment['submit_date']) . '</span>
            </div>
            
            <div class="comment_content">
                <h3>'. $title .'</h3>
                ' . $content . '
                ' . ($comment['approved'] ? '' : '<br><br><i>(Awaiting approval)</i>') . '
            </div>
            <div class="comment_footer">
                <span class="num">' . number_format($comment['votes']) . '</span>
                <a href="#" class="vote" data-vote="up" data-comment-id="' . $comment['id'] . '">
                    <i class="arrow up"></i>
                </a>
                <a href="#" class="vote" data-vote="down" data-comment-id="' . $comment['id'] . '">
                    <i class="arrow down"></i>
                </a>
                <a class="reply_comment_btn" href="#" data-comment-id="' . $comment['id'] . '">Reply</a>
            
                ' . (isset($_SESSION['comment_account_loggedin']) && $_SESSION['comment_account_role'] == 'Admin' ? '<a class="edit_comment_btn" href="admin/comment.php?id=' . $comment['id'] . '" target="_blank">Edit</a>' : '') . '
            </div>
            <div class="replies">' . ($current_nest < max_nested_replies ? show_comments($comments, $filters, $max_comments, $comment['id'], $current_nest+1) : '') . '</div>
        </div>
        
    </div>
    
    ' . ($current_nest >= max_nested_replies ? show_comments($comments, $filters, $max_comments, $comment['id'], $current_nest+1) : '');
    return $html; 
    }
    
}
// Output an array of comments
function show_comments($comments, $filters, $max_comments = -1, $parent_id = -1, $current_nest = 0) {
    
    $html = '';
    if ($parent_id != -1) {
        array_multisort(array_column($comments, 'submit_date'), SORT_ASC, $comments);
    }
    foreach ($comments as $i => $comment) {
        if ($comment['parent_id'] == $parent_id) {
            $html .= show_comment($comment, $comments, $filters, $max_comments, $current_nest);
        }
    }
    return $html;
}
// Output the write comment form
function show_write_comment_form($parent_id = -1) {
    $input_html = '';
    if (authentication_required && !isset($_SESSION['comment_account_loggedin'])) {
        $input_html = '
        <p></p>
        ';
    } else if (!authentication_required) {
        $input_html = '
        <p></p>
        ';       
    }
    $input_html .= photo_icon_url_enabled ? '<input type="url" name="img_url" placeholder="Photo Icon URL (optional)">' : '';
    
    if(isset($_SESSION["loggedIn"])){
        $html = '
     <div class="write_comment hidden" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            ' . $input_html . '
            <div class="content">
                <textarea name="title"  placeholder = "Title your post" maxlength = "50"></textarea>
                <textarea name="content" placeholder="Content" maxlength="' . max_comment_chars . '" required></textarea>
                <div class="toolbar">
                    <i class="format-btn fa-solid fa-bold"></i>
                    <i class="format-btn fa-solid fa-italic"></i>
                    <i class="format-btn fa-solid fa-underline"></i>
                    <i class="format-btn fa-solid fa-heading"></i>
                    <i class="format-btn fa-solid fa-quote-left"></i>
                    <i class="format-btn fa-solid fa-code"></i>
                </div>
                Add an image: <br>
                <input type="file" name="userImage">
                <br>
            </div>
            <p class="msg"></p>
            <div class="group">
                <button type="submit" class="post_button">Post</button>
                <button type="submit" class="alt cancel_button">Cancel</button>
            </div>
        </form>
    </div>
    ';    
    }else{
        $html = '
    <div class="write_comment hidden" data-comment-id="' . $parent_id . '">
        <form>
            <input name="parent_id" type="hidden" value="' . $parent_id . '">
            ' . $input_html . '
            <div class="content">
                <div class="toolbar">
                    <i class="format-btn fa-solid fa-bold"></i>
                    <i class="format-btn fa-solid fa-italic"></i>
                    <i class="format-btn fa-solid fa-underline"></i>
                    <i class="format-btn fa-solid fa-heading"></i>
                    <i class="format-btn fa-solid fa-quote-left"></i>
                    <i class="format-btn fa-solid fa-code"></i>
                </div>
            </div>
            <p class="msg"></p>
            <div class="group">
                <p> You cannot post as you are not logged in </p>
            </div>
        </form>
    </div>
    ';              }
                
    
    return $html;
}
// Page ID needs to exist as it is used to determine which comments are for which page.
if (isset($_GET['page_id'])) {
    // Retrieve the filters
    $stmt = $pdo->prepare('SELECT * FROM filters');
    $stmt->execute();
    $filters = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // IF the user submits the write comment form
    if (isset($_POST['content'], $_POST['parent_id'])) {
        // Validation
        if (strlen($_POST['content']) > max_comment_chars) {
            exit('Error: comment content must be no longer than ' . max_comment_chars . ' characters long!');
        }
        // Display name must contain only characters and numbers.
        if (isset($_POST['name']) && !preg_match('/^[a-zA-Z0-9]+$/', $_POST['name'])) {
            exit('Error: Display name must contain only letters and numbers!');
        }
        // Check if authentication required
        $toID = $_SESSION['id'];
        $stmt = $pdo->prepare('SELECT * FROM account WHERE id = ?');
        $stmt->execute([$toID]);
        $filters = $stmt->fetch();
        $banStat = $filters['banned'];
        if (authentication_required && !isset($_SESSION['comment_account_loggedin']) || $banStat == 'banned') {
            // No input data captured
           
            if($banStat == 'banned'){
                exit('Error: You have been banned, unable to post');
            }
            if (!isset($_POST['email'], $_POST['password'])) {
                exit('Error: Please login to post a comment!');
            }
            // Retrieve the account
            $stmt = $pdo->prepare('SELECT * FROM accounts WHERE email = ?');
            $stmt->execute([ $_POST['email'] ]);
            $account = $stmt->fetch(PDO::FETCH_ASSOC); 
            // Account exists + verify password
            if ($account) {
                if (password_verify($_POST['password'], $account['password'])) {
                    $_SESSION['comment_account_loggedin'] = TRUE;
                    $_SESSION['comment_account_id'] = $account['id'];
                    $_SESSION['comment_account_display_name'] = $account['display_name'];
                    $_SESSION['comment_account_role'] = $account['role']; 
                } else {
                    exit('Error: Incorrect email and/or password!');
                }
            } else {
                // Account doesn't exist, create one...
                $role = 'Member';
                $stmt = $pdo->prepare('INSERT INTO accounts (email, password, display_name, role) VALUES (?,?,?,?)');
                $stmt->execute([ $_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['name'], $role ]);     
                $_SESSION['comment_account_loggedin'] = TRUE;
                $_SESSION['comment_account_id'] = $pdo->lastInsertId();
                $_SESSION['comment_account_display_name'] = $_POST['name'];  
                $_SESSION['comment_account_role'] = $role;   
            }       
        }
        // Declare variables
        $approved = comments_approval_required ? 0 : 1;
        //PROFILE PIC
        
        $acc_id = isset($_SESSION['comment_account_loggedin']) ? $_SESSION['comment_account_id'] : -1; 
        $name = isset($_SESSION['comment_account_display_name']) ? $_SESSION['comment_account_display_name'] : $_SESSION['loggedIn']; 
        // Insert a new comment
        $target_dir = "uploads/";
        //image section
        $imgT = false;
        if(isset($_FILES["userImage"])){
        $imgT = true;
        $target_file = $target_dir . basename($_FILES["userImage"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
        $uploadOk = 0;
        $imgT = false;
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.') </script>";
        }
        }
        if ($_FILES["userImage"]["size"] > 100000 && $imgT == true) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
            echo "<script>alert('Failed to upload i')";
          }
          if($uploadOk == 0 && $imgT == True){
            echo "<script>alert('Sorry, file fail.') </script>";
            
            exit();
        }else {
        //
        
        
        $sql1 = "INSERT INTO commentimg (postID, contentType, img) VALUES(?,?,?)";
        $stmt = $pdo->prepare('INSERT INTO comments (page_id, parent_id, display_name, title, content, submit_date, approved, acc_id) VALUES (?,?,?,?,?,?,?,?)');
        $stmt->execute([ $_GET['page_id'], $_POST['parent_id'], $name, $_POST['title'], $_POST['content'], date('Y-m-d H:i:s'), $approved, $acc_id ]);
        if($imgT == True){
        $imagedata = file_get_contents($_FILES['userImage']['tmp_name']);
        $postID = $pdo->lastInsertId();
        $statement = mysqli_stmt_init($connection); //init prepared statement object
        mysqli_stmt_prepare($statement, $sql1); // register the query
        $null = NULL;
        mysqli_stmt_bind_param($statement, "isb", $postID, $imageFileType, $null);
        mysqli_stmt_send_long_data($statement, 2, $imagedata);
        $result = mysqli_stmt_execute($statement) or die(mysqli_stmt_error($stmt));
        mysqli_stmt_close($statement);
        }
        // Retrieve the comment
        $stmt = $pdo->prepare('SELECT * FROM comments WHERE id = ?');
        $stmt->execute([ $pdo->lastInsertId() ]);
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);
        // Output the comment
        exit(show_comment($comment));
        }
    }
    // IF the user clicks one of the vote buttons
    if (isset($_GET['vote'], $_GET['comment_id'])) {
        // Check if the cookie exists for the specified comment
        if (!isset($_COOKIE['vote_' . $_GET['comment_id']])) {
            // Cookie does not exists, update the votes column and increment/decrement the value
            $stmt = $pdo->prepare('UPDATE comments SET votes = votes ' . ($_GET['vote'] == 'up' ? '+' : '-') . ' 1 WHERE id = ?');
            $stmt->execute([ $_GET['comment_id'] ]);
            // Set vote cookie, this will prevent the users from voting multiple times on the same comment, cookie expires in 10 years
            setcookie('vote_' . $_GET['comment_id'], 'true', time() + (10 * 365 * 24 * 60 * 60), '/');
        }
        // Retrieve the number of votes from the comments table
        $stmt = $pdo->prepare('SELECT votes FROM comments WHERE id = ?');
        $stmt->execute([ $_GET['comment_id'] ]);
        $comment = $stmt->fetch(PDO::FETCH_ASSOC);
        // Output the votes
        exit($comment['votes']);
    }
    // If the limit variables exist, add the LIMIT clause to the SQL statement
    $comments_per_pagination_page = isset($_GET['comments_to_show']) ? $_GET['comments_to_show'] : -1;
    // By default, order by the submit data (newest)
    $sort_by = 'ORDER BY votes DESC, submit_date DESC';
    if (isset($_GET['sort_by'])) {
        // User has changed the sort by, update the sort_by variable
        $sort_by = $_GET['sort_by'] == 'newest' ? 'ORDER BY submit_date DESC' : $sort_by;
        $sort_by = $_GET['sort_by'] == 'oldest' ? 'ORDER BY submit_date ASC' : $sort_by;
        $sort_by = $_GET['sort_by'] == 'votes' ? 'ORDER BY votes DESC, submit_date DESC' : $sort_by;
    }
    // Get all comments by the Page ID ordered by the submit date
    $stmt = $pdo->prepare('SELECT * FROM comments WHERE page_id = :page_id AND approved = 1 ' . $sort_by);
    // Bind the page ID to our query
    $stmt->bindValue(':page_id', $_GET['page_id'], PDO::PARAM_INT);
    $stmt->execute();
    $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // Get the overall rating and total number of comments
    $stmt = $pdo->prepare('SELECT COUNT(*) AS total_comments FROM comments WHERE page_id = ? AND approved = 1');
    $stmt->execute([ $_GET['page_id'] ]);
    $comments_info = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    exit('No page ID specified!');
}
?>
<div class="comment_header">
    <span class="total"><?=number_format($comments_info['total_comments'])?> Posts</span>
    <div class="sort_by">
        <a href="#">Sort by <?=isset($_GET['sort_by']) ? htmlspecialchars(ucwords($_GET['sort_by']), ENT_QUOTES) : 'Votes'?><i class="fa-solid fa-caret-down fa-sm"></i></a>
        <div class="options">
            <a href="#" data-value="votes">Votes</a>
            <a href="#" data-value="newest">Newest</a>
            <a href="#" data-value="oldest">Oldest</a>
        </div>
    </div>
</div>

<div class="comment_content">
    <input type="text" placeholder="Create a post" class="comment_placeholder_content" data-comment-id="-1">
</div>

<?=show_write_comment_form()?>

<div class="comments_wrapper">
    <?=show_comments($comments, $filters, $comments_per_pagination_page)?>
</div>

<?php if (!$comments): ?>
<p class="no_comments">There are no comments.</p>
<?php endif; ?>

<?php if ($comments_per_pagination_page != -1 && $comments_per_pagination_page < $comments_info['total_comments']): ?>
<a href="#" class="show_more_comments">Show More</a>
<?php endif; ?>