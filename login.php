<?php
    require_once "dbConfig.php";
    $errorMessage = "";
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "select * from user where username ='$username'";
        $result = mysqli_query($conn,$sql);
        $data = mysqli_fetch_array($result);
        if(is_null($data)||
            $data['password']!==$password){
            $errorMessage = "username or password is incorrect!";
        }else{
            $id = $data['userID'];
            $sql = "update user set active = '1' where userID = '$id'";
            mysqli_query($conn,$sql);
            require "index.php";
            die();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Login</title>
    <style>
        div.errorMessage{
            color: red;
        }
    </style>
</head>
<body>

    <?php
        require "header.php";
    ?>

    <form action="login.php" method="POST" name="loginForm">
        <div class="inputGroup">
            <label for="username"> Username : </label>
            <input type="text" name="username" id="usernameField">
        </div>
        <div class="inputGroup">
            <label for="password"> Password: </label>
            <input type="password" name="password" id="passwordField">
        </div>
        <div class="errorMessage" > <?php echo $errorMessage ?> </div>
        <div class="controlButtons">
            <input type="submit" id="submitButton" value="Login">
            <a href="signUp.php">SignUp</a>
        </div>
    </form>
</body>
</html>