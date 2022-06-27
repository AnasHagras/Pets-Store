<?php
    require_once "dbConfig.php";
    @$id = mysqli_fetch_array(mysqli_query($conn,"select * from user where active = '1'"))['userID'];
    @$addressID = mysqli_fetch_array(mysqli_query($conn,"select * from user where active = '1'"))['addressID'];
    $sql = "delete from pet where userID = '$id'";
    mysqli_query($conn,$sql);
    $sql = "delete from orders where userID = '$id'";
    mysqli_query($conn,$sql);
    $sql = "delete from user where active = '1'";
    mysqli_query($conn,$sql);
    $sql = "delete from address where addressID = '$addressID'";
    mysqli_query($conn,$sql);
    require "index.php";
?>