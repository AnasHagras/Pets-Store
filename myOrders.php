<?php
    require_once "dbConfig.php";
    if(is_null(mysqli_fetch_array(mysqli_query($conn,"select * from user where active = 1 ")))){
        $errorMessage = "<a href='login.php'>Please Login First</a>";
    }
    if(isset($GET['id'])){
        $viewItem = "YES";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>buildAPlush | Orders</title>
    <style>
        table th{
            border: 1px solid saddlebrown;
        }
        span{
            font-family: 'Courier New', Courier, monospace !important;
        }
        .prep{
            color: red;
        }
        .del{
            color: orange;
        }
        .arrived{
            color: green;
        }
        table div{
            width: 30px;
            height: 30px;
            border: 1px solid green;
        }
        table caption{
            color: green;
            margin-top: 60px;
            margin-bottom: -50px;
        }
    </style>
</head>
<body>
    <?php
        require "header.php";
    ?>
    <?php 
        if(isset($errorMessage)){
            echo $errorMessage;
        }else {
            echo "<table>
            <tr>
                <th>OrderNo.</th>
                <th>OrderID</th>
                <th>Order Date</th>
                <th>Arrive Date</th>
                <th>Item Count</th>
                <th>Total Price</th>
                <th>State</th>
                <th>View Items</th>
                <th>Delete</th>
            </tr>";
            $result = mysqli_query($conn,"select * from orders where userID = (select userID from user where active = 1)");
            $counter = 1;
            while($currentOrder = mysqli_fetch_assoc($result)){
                $state = "";
                $className = "";
                $orderDate = date_format(date_create($currentOrder['orderDate']),"y-m-d h:i:s");
                $arriveDate = date_format(date_create($currentOrder['arriveDate']),"y-m-d h:i:s");
                $deliveryTime = date_format(date_sub(date_create($currentOrder['arriveDate']),date_interval_create_from_date_string("1 minutes")),"y-m-d h:i:s");
                // if time now before deleviry 
                if(date("y-m-d h:i:s") < $deliveryTime){
                    $state = "Preparing";
                    $className = "prep";
                }
                // if time now after deleviry and before arrive
                else if (date("y-m-d h:i:s") < $arriveDate){
                    $state = "Out For Delivery";
                    $className = "del";
                }
                // if time now after arrive
                else{
                    $state = "Arrived";
                    $className = "arrived";
                }
                echo "<tr>";
                echo "<td>" . $counter++ ."</td>";
                echo "<td>" . $currentOrder['orderID'] . "</td>";
                echo "<td>" . $orderDate . "</td>";
                echo "<td>" . $arriveDate . "</td>";
                echo "<td>" . $currentOrder['itemCount'] . "</td>";
                echo "<td>" . $currentOrder['price'] . "</td>";
                echo "<td>" . "<span class = '$className'>$state</span>" . "</td>";
                echo "<td>" . "<a href='myOrders.php?id=$currentOrder[orderID]'>View Items</a>";
                echo "<td>" . "<a href='deleteOrder.php?id=$currentOrder[orderID]'>Delete Order</a>";
                echo "</tr>";
            }
            echo "</table>";
            // table for view items 
            $state = isset($_GET['id'])?"table":"none";
            echo "<table style=display:$state;>";
            if(isset($_GET['id']))echo "<caption>Order ID : $_GET[id]<a href='myOrders.php'>Close</a></caption>";
            echo "<tr>
                <th>item No.</th>
                <th>Type</th>
                <th>earShape</th>
                <th>eyeColor</th>
                <th>furPattern</th>
                <th>baseColor</th>
                <th>alterColor1</th>
                <th>alterColor2</th>
                <th>size</th>
                <th>unitPrice</th>
                <th>count</th>
                <th>totalPrice</th>
                </tr>";
            $totalPrice = 0;
            if(isset($_GET['id']))$result = mysqli_query($conn,"select * from pet where orderID=$_GET[id]");
            $counter = 1;
            while($currentPet = mysqli_fetch_assoc($result)){
                $baseColor = "baseColor";
                $alterColor1 = "alterColor1";
                $alterColor2 = "alterColor2";
                $eyeColor = "eyeColor";
                $totalPrice += $currentPet["price"]*$currentPet['counter'];
                echo "<tr>";
                echo "<td>" . $counter++ ."</td>";
                echo "<td>" . $currentPet['type'] . "</td>";
                echo "<td>" . $currentPet['earShape'] . "</td>";
                echo "<td>" . "<div class='eyeColor' style = 'background-color:$currentPet[$eyeColor]'></div>". "</td>";
                echo "<td>" . $currentPet['furPattern'] . "</td>";
                echo "<td>" . "<div class='baseColor' style = 'background-color:$currentPet[$baseColor]'></div>"."</td>";
                echo "<td>" . "<div class='baseColor' style = 'background-color:$currentPet[$alterColor1]'></div>" . "</td>";
                echo "<td>" . "<div class='baseColor' style = 'background-color:$currentPet[$alterColor2]'></div>". "</td>";
                echo "<td>" . $currentPet['size'] . "</td>";
                echo "<td>" . $currentPet['price'] . " €"."</td>";
                echo "<td>" . $currentPet['counter']."</td>";
                echo "<td>" . $currentPet['price']*$currentPet['counter'] ."</td>";
                echo "</tr>";
            }
                echo "</table>";
        }
    ?>
</body>
</html>