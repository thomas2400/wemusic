<?php
    session_start();
    session_unset();
    session_destroy();

    echo "<script>alert('Successfully logged out account.');";
    echo "window.location ='index.php';</script>";
?>