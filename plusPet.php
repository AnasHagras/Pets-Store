<?php
    require_once "dbConfig.php";
    $id = $_GET['id'];
    $sql = "update pet set counter = ((select counter from pet where petID = '$id')+1) where petID = '$id'";
    mysqli_query($conn,$sql);
    header("Location: chart.php");
?>