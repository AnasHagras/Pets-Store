<?php 
    require_once "dbConfig.php";
    $data = mysqli_fetch_array(mysqli_query($conn,"select * from user where active = '1'"));
    $name = $data['name'];
    $username = $data['username'];
    $age = $data['age'];
    $email = $data['email'];
    $phoneNumber = $data['phoneNumber'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wnameth=device-wnameth, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Profile</title>
</head>
<body>
    <?php
        require_once "header.php";
    ?>
    <form action="update.php" method="POST" name="updateForm">
        <div class="inputGroup">
            <label for="name">name : </label>
            <input type="text" name = "name" value = <?php echo $name?>>
        </div>
        <div class="inputGroup">
            <label for="username">Username : </label>
            <input type="text" name = "username" value = <?php echo $username?>>
        </div>
        <div class="inputGroup">
            <label for="age">Age : </label>
            <input type="number" name = "age" value = <?php echo $age?>>
        </div>
        <div class="inputGroup">
            <label for="email">email : </label>
            <input type="text" name = "email" value = <?php echo $email?>>
        </div>
        <div class="inputGroup">
            <label for="phoneNumber">phoneNumber : </label>
            <input type="text" name = "phoneNumber" value = <?php echo $phoneNumber?>>
        </div>
        <div class="inputGroup">
            <label for="newPassword">new Password : </label>
            <input type="text" name = "newPassword" placeholder="empty = no change" >
        </div>
        <div class="inputGroup">
            <label for="password">password : </label>
            <input type="password" name = "password">
        </div>
        <div class="inputGroup">
            <label for="passwordConfirm">confirm password : </label>
            <input type="password" name = "passwordConfirm" >
        </div>
        <div class="controlDiv">
            <input type="submit" value="Update" name = "update">
        </div>
    </form>
    <div class="message">
        <?php 
            if(isset($errorMessage)){
                echo $errorMessage ;
            }
        ?>
    </div>
    <a href="logout.php">Logout</a>
    <a href="delete.php">delete my account</a>
</body>
</html>