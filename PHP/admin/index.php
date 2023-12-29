<?php
include 'main.php';
$stmt = $pdo->prepare('SELECT * FROM comments WHERE cast(submit_date as DATE) = cast(now() as DATE) ORDER BY submit_date DESC');
$stmt->execute();
$comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of comments
$stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM comments WHERE approved = 0');
$stmt->execute();
$awaiting_approval = $stmt->fetchColumn();
// Get the total number of comments
$stmt = $pdo->prepare('SELECT COUNT(*) AS total FROM comments');
$stmt->execute();
$comments_total = $stmt->fetchColumn();
// Get the total number of comments
$stmt = $pdo->prepare('SELECT COUNT(page_id) AS total FROM comments GROUP BY page_id');
$stmt->execute();
$comments_page_total = $stmt->fetchAll(PDO::FETCH_ASSOC);
$comments_page_total = count($comments_page_total);
// Get the comments awaiting approval
$stmt = $pdo->prepare('SELECT * FROM comments WHERE approved = 0 ORDER BY submit_date DESC');
$stmt->execute();
$comments_awaiting_approval = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_admin_header('Dashboard', 'dashboard')?>

<div class="content-title">
    <h2>Dashboard</h2>
</div>

<div class="dashboard">
    <div class="content-block stat">
        <div class="data">
            <h3>New Posts</h3>
            <p><?=number_format(count($comments))?></p>
        </div>
        <i class="fas fa-comments"></i>
        <div class="footer">
            <i class="fa-solid fa-rotate fa-xs"></i>Total Posts for today
        </div>
    </div>


    <div class="content-block stat">
        <div class="data">
            <h3>Total Comments</h3>
            <p><?=number_format($comments_total)?></p>
        </div>
        <i class="fas fa-comments"></i>
        <div class="footer">
            <i class="fa-solid fa-rotate fa-xs"></i>Total Posts
        </div>
    </div>

    <div class="content-block stat">
        <div class="data">
            <h3>Total Pages</h3>
            <p><?=number_format($comments_page_total)?></p>
        </div>
        <i class="fas fa-file-alt"></i>
        <div class="footer">
            <i class="fa-solid fa-rotate fa-xs"></i>Total pages
        </div>
    </div>
</div>

<div class="content-title">
    <h2>New Posts</h2>
</div>

<div class="content-block">
    <div class="table">
        <table>
            <thead>
                <tr>
                    <td colspan="2">Name</td>
                    <td>Content</td>
                    <td class="responsive-hidden">Votes</td>
                    <td class="responsive-hidden">Date Posted</td>
                    <td>Actions</td>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($comments)): ?>
                <tr>
                    <td colspan="8" style="text-align:center;">There are no recent posts</td>
                </tr>
                <?php else: ?>
                <?php foreach ($comments as $comment): ?>
                <tr>
                    <td class="img">
                        <?=!empty($comment['img']) ? '<img src="' . htmlspecialchars($comment['img'], ENT_QUOTES) . '" alt="' . htmlspecialchars($comment['display_name'], ENT_QUOTES) . '\'s Profile Image">' : '<span style="background-color:' . color_from_string($comment['display_name']) . '">' . strtoupper(substr($comment['display_name'], 0, 1)) . '</span>';?>
                    </td>
                    <td><?=htmlspecialchars($comment['display_name'], ENT_QUOTES)?></td>
                    <td><?=nl2br(htmlspecialchars($comment['content'], ENT_QUOTES))?></td>
                    <td class="responsive-hidden"><?=number_format($comment['votes'])?></td>
                    <td class="responsive-hidden"><?=date('F j, Y H:ia', strtotime($comment['submit_date']))?></td>
                    <td>
                        <a href="comment.php?id=<?=$comment['id']?>" class="link1">Edit</a>
                        <a href="comments.php?delete=<?=$comment['id']?>" class="link1" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a>
    
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>

            </tbody>
        </table>
    </div>
    
</div>

<div class="content-title">
    <h2 style = "margin-top: 2.5em;">Set Community Updates </h2>
</div>

<div class="content-block">
    <form method = "post" action = "newsUpdate.php">
        <fieldset>
        <label>Community Update or General News?</label></br>
        <input name = "newsType" id = "CU" type = "radio" value ="CU" required>Community Update</br>
        <input name = "newsType" id = "GN" type = "radio" value = "GN" required>General News</br>
        <label>Title</label></br>
        <input name = "title" type = "text" required></br>
        <label>Content:</label></br>
        <textarea name="cont" rows="5" cols="61" required></textarea></br>
        <input type = "submit">
    </fieldset>
    </form>
    
</div>
<div class="content-block">
    <form method = "post" action = "guidelineUpdate.php">
        <fieldset>
        <label>Community Guideline</label></br>
        <input name = "newsType" id = "CG" type = "radio" value ="CU" required>Community Guidelines</br>
        <label>Title</label></br>
        <input name = "title" type = "text" required></br>
        <label>Content:</label></br>
        <textarea name="cont" rows="5" cols="61" required></textarea></br>
        <input type = "submit">
    </fieldset>
    </form>
    
</div>

<?=template_admin_footer()?>