<?php 
    require_once "dbConfig.php";
    $sql = "update user set active = '0' where active = '1'";
    mysqli_query($conn,$sql);
    header("Location: login.php");
?>