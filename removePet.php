<?php
    require "dbConfig.php";
    mysqli_query($conn,"delete from pet where petID = $_GET[id]");
    header("Location: chart.php");
?>