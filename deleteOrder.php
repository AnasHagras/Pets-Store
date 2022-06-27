<?php
    require_once "dbConfig.php";
    $id = $_GET['id'];
    mysqli_query($conn,"delete from pet where orderID = '$id'");
    mysqli_query($conn,"delete from orders where orderID = '$id'");
    header("Location: myOrders.php");
?>