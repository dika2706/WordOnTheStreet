<?php
    session_start();
    session_destroy();
    echo "<script>alert('Logged out. Sending you to home page.'); window.location.href='../../home.php';</script>";

?>