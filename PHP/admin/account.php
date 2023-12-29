<?php
include 'main.php';
// Default account product values
$account = [
    'user' => '',
    'password' => '',
    'auth' => 'Member',
    'displayName' => ''
];
if (isset($_GET['id'])) {
    // Retrieve the account from the database
    $stmt = $pdo->prepare('SELECT * FROM account WHERE id = ?');
    $stmt->execute([ $_GET['id'] ]);
    $account = $stmt->fetch(PDO::FETCH_ASSOC);
    // ID param exists, edit an existing account
    $page = 'Edit';
    if (isset($_POST['submit'])) {
        // Update the account
        $ban = $_POST['ban'];
        $password = $_POST['password'];
        if($ban == 's'){
            $banVal = 'safe';
        }else {
            $banVal = 'banned';
        }
        if(empty($_POST['password'])){
        $stmt = $pdo->prepare('UPDATE account SET user = ?, auth = ?, displayName = ?, banned = ? WHERE id = ?');
        $stmt->execute([ $_POST['email'], $_POST['role'], $_POST['display_name'], $banVal , $_GET['id'] ]);
        header('Location: accounts.php?success_msg=2');
        exit;
        }else{
        $stmt = $pdo->prepare('UPDATE account SET user = ?, password = ?, auth = ?, displayName = ?, banned = ? WHERE id = ?');
        $stmt->execute([ $_POST['email'], md5($password), $_POST['role'], $_POST['display_name'], $banVal , $_GET['id'] ]);
        header('Location: accounts.php?success_msg=2');
        }
        exit;
    }
    if (isset($_POST['delete'])) {
        // Delete the account
        $stmt = $pdo->prepare('DELETE FROM account WHERE id = ?');
        $stmt->execute([ $_GET['id'] ]);
        header('Location: accounts.php?success_msg=3');
        exit;
    }
} else {
    // Create a new account
    $page = 'Create';
    if (isset($_POST['submit'])) {
        $password =($_POST['password']);
        $stmt = $pdo->prepare('INSERT INTO account (user,password,auth,displayName) VALUES (?,?,?,?)');
        $stmt->execute([ $_POST['email'], $password, $_POST['role'], $_POST['display_name'] ]);
        header('Location: accounts.php?success_msg=1');
        exit;
    }
}
?>
<?=template_admin_header($page . ' Account', 'accounts', 'manage')?>

<form action="" method="post">

    <div class="content-title responsive-flex-wrap responsive-pad-bot-3">
        <h2 class="responsive-width-100"><?=$page?> Account</h2>
        <a href="accounts.php" class="btn alt mar-right-2">Cancel</a>
        <?php if ($page == 'Edit'): ?>
        <input type="submit" name="delete" value="Delete" class="btn red mar-right-2" onclick="return confirm('Are you sure you want to delete this account?')">
        <?php endif; ?>
        <input type="submit" name="submit" value="Save" class="btn">
    </div>

    <div class="content-block">

        <div class="form responsive-width-100">

            <label for="email"><i class="required">*</i> Email</label>
            <input id="email" type="email" name="email" placeholder="Email" value="<?=htmlspecialchars($account['user'], ENT_QUOTES)?>" required>

            <label for="password"><?=$page == 'Edit' ? 'New ' : ''?>Password</label>
            <input type="text" id="password" name="password" placeholder="<?=$page == 'Edit' ? 'New ' : ''?>Password" value=""<?=$page == 'Edit' ? '' : ' required'?>>

            <label for="display_name">Display Name</label>
            <input id="display_name" type="text" name="display_name" placeholder="Name" value="<?=htmlspecialchars($account['displayName'], ENT_QUOTES)?>">
            
            <label for="role"><i class="required">*</i> Role</label>
            <select id="role" name="role" required>
                <option value="Member"<?=$account['auth']=='Member'?' selected':''?>>Member</option>
                <option value="Admin"<?=$account['auth']=='Admin'?' selected':''?>>Admin</option>
            </select>
            <label>
            <input name = "ban" type = "radio" value ="s" >Safe</br>
            <input name = "ban" type = "radio" value = "b">Ban</br>
        </label>
        </br>
           
        

        </div>

    </div>

</form>

<?=template_admin_footer()?>