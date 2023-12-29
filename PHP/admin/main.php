<?php
session_start();
// Include the configuration file
include_once '../config.php';
// Check if admin is logged in
if (!isset($_SESSION['comment_account_loggedin'])) {
    header('Location: login.php');
    exit;
}
try {
    $pdo = new PDO('mysql:host=' . db_host . ';dbname=' . db_name . ';charset=' . db_charset, db_user, db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to database!');
}
// If the user is not admin redirect them back to home page
$stmt = $pdo->prepare('SELECT * FROM account WHERE id = ?');
$stmt->execute([ $_SESSION['comment_account_id'] ]);
$account = $stmt->fetch(PDO::FETCH_ASSOC);
// Ensure account is an admin
if (!$account || $account['auth'] != 'Admin') {
    header('Location: login.php');
    exit;
}
// The following function will be used to assign a unique icon color to our users
function color_from_string($string) {
    // The list of hex colors
    $colors = ['#8C273B', '#3D3D3D', '#F7A278', '#1F2022', '#CAB8A8', '#83C5BE', '#E3A9D9', '#A7D948', '#F1C232', '#D32D41'];
    // Find color based on the string
    $colorIndex = hexdec(substr(sha1($string), 0, 10)) % count($colors);
    // Return the hex color
    return $colors[$colorIndex];
}
// Template admin header
function template_admin_header($title, $selected = 'orders', $selected_child = 'view') {
    
    $admin_links = '
        <a href="index.php"' . ($selected == 'dashboard' ? ' class="selected"' : '') . '><i class="fas fa-tachometer-alt"></i>Dashboard</a>
        <a href="comments.php"' . ($selected == 'comments' ? ' class="selected"' : '') . '><i class="fas fa-comments"></i>Posts</a>
        <div class="sub">
            <a href="comments.php"' . ($selected == 'comments' && $selected_child == 'view' ? ' class="selected"' : '') . '><span>&#9724;</span>View Posts</a>
            <a href="comment.php"' . ($selected == 'comments' && $selected_child == 'manage' ? ' class="selected"' : '') . '><span>&#9724;</span>Create Post</a>
        </div>
        <a href="filters.php"' . ($selected == 'filters' ? ' class="selected"' : '') . '><i class="fas fa-filter"></i>Updates</a>
        <div class="sub">
            <a href="filters.php"' . ($selected == 'filters' && $selected_child == 'view' ? ' class="selected"' : '') . '><span>&#9724;</span>View Updates</a>
            <a href="filter.php"' . ($selected == 'filters' && $selected_child == 'manage' ? ' class="selected"' : '') . '><span>&#9724;</span>Create Word Replacement</a>
        </div>
        <a href="accounts.php"' . ($selected == 'accounts' ? ' class="selected"' : '') . '><i class="fas fa-users"></i>Accounts</a>
        <div class="sub">
            <a href="accounts.php"' . ($selected == 'accounts' && $selected_child == 'view' ? ' class="selected"' : '') . '><span>&#9724;</span>View Accounts</a>
            <a href="account.php"' . ($selected == 'accounts' && $selected_child == 'manage' ? ' class="selected"' : '') . '><span>&#9724;</span>Create Account</a>
        </div>
    ';
echo <<<EOT
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>$title</title>
        <link rel="icon" type="image/png" href="../favicon.png">
		<link href="admin.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
		
	</head>
	<body class="admin">
        <aside class="responsive-width-100 responsive-hidden">
            <h1>Admin</h1>
            $admin_links
            <div class="footer">
                <p><i>Copyright &copy; COSC360-Project</i></p>
            </div>
        </aside>
        <main class="responsive-width-100">
            <header>
                <a class="responsive-toggle" href="#">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="space-between"></div>
                <div class="dropdown right">
                    <i class="fas fa-user-circle"></i>
                    <div class="list">
                        <a href=../home.php>Back to Home</a>
                        <a href="account.php?id={$_SESSION['comment_account_id']}">Edit Profile</a>
                        <a href = "../login/account/account.php"> Change my profile </a>
                        <a href="logout.php">Logout</a>

                    </div>
                </div>
            </header>
EOT;
}
// Template admin footer
function template_admin_footer($js_script = '') {
        $js_script = $js_script ? '<script>' . $js_script . '</script>' : '';
echo <<<EOT
        </main>
        <script src="admin.js"></script>
        {$js_script}
    </body>
</html>
EOT;
}
?>