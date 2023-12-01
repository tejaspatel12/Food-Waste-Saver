<?php
    session_start();
    unset($_SESSION["restaurant_name"]);
    unset($_SESSION["restaurant_id"]);
    echo "<script>window.location='login.php';</script>";
?>