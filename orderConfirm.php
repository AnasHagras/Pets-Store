<?php
    require_once "dbConfig.php";
    if($_POST['totalPrice']==0){
        $erd = "no items here";
        require_once "chart.php";
    }else {
        $itemCount = 0 ;
        $sql = "select * from pet where state = -1 and userID = (select userID from user where active = 1)";
        $result = mysqli_query($conn,$sql);
        while($order = mysqli_fetch_array($result)){
            $itemCount += $order['counter'];
        }
        $orderDate = date("y-m-d h:i:s");
        $arriveDate = date("y-m-d h:i:s",strtotime("+2 minutes"));
        $sql = "insert into orders (userID,price,state,orderDate,arriveDate,itemCount)values
        ((select userID from user where active = '1'),
        $_POST[totalPrice],0,
        '$orderDate','$arriveDate',$itemCount)";
        mysqli_query($conn,$sql);
        $id = mysqli_insert_id($conn);
        $sql = "update pet set state = 0 , orderID = $id where userID = (select userID from user where active = '1')
        and state = -1";
        mysqli_query($conn,$sql);
        header("Location: myOrders.php");
    }
    
?>