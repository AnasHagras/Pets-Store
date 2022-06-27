<?php
    require_once "dbConfig.php";
    $counter = mysqli_fetch_array(mysqli_query($conn,"select counter from pet where petID = '$_GET[id]'"))['counter'];
    if($counter==1){
        header("Location: removePet.php?id=$_GET[id]");
    }else{
        mysqli_query($conn,"update pet set counter = ($counter-1) where petID = '$_GET[id]'");
        header("Location: chart.php");
    }
?>