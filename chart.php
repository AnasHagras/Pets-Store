<?php
    require_once "dbConfig.php";
    if(is_null(mysqli_fetch_array(mysqli_query($conn,"select * from user where active = 1 ")))){
        $errorMessage = "<a href='login.php'>Please Login First</a>";
    }
    // var_dump($items);
    // var_dump(mysqli_fetch_array($result));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Plush Store | Chart</title>
    <style>
        table th{
            border: 1px solid green;
        }
        table div{
            width: 30px;
            height: 30px;
            border: 1px solid green;
        }
    </style>
</head>
<body>
    <?php require "header.php"?>
     <!-- make table here with data and confirm order and edit delete buttons and total price bar -->
    <?php 
        if(isset($errorMessage)){
            echo $errorMessage;
        }else {
            echo "<table>
            <tr>
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
                <th>inc</th>
                <th>dec</th>
                <th>--------</th>
            </tr>";
            $totalPrice = 0;
            $result = mysqli_query($conn,"select * from pet where state = '-1' and userID = (select userID from user where active = 1)");
            $counter = 1;
            while($currentPet = mysqli_fetch_assoc($result)){
                $baseColor = "baseColor" ;
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
                echo "<td>" ."<a href='plusPet.php?id=$currentPet[petID]'>+</a>"."</td>";
                echo "<td>" ."<a href='minusPet.php?id=$currentPet[petID]'>-</a>"."</td>";
                echo "<td>" ."<a href='removePet.php?id=$currentPet[petID]'>Remove</a>"."</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "Total Price : " .$totalPrice ;
            echo "<form method='POST' action = orderConfirm.php>
                <input type='hidden'name='totalPrice' value = $totalPrice>                
                <input type='submit' value='confirm order'>
            </form>";
        }
    ?>
    <div class="message"><?php echo isset($erd)?$erd:""?></div>
</body>
</html>