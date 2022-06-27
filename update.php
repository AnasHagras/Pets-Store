<?php
    require_once "dbConfig.php";
    if(isset($_POST['update'])){
        $username = mysqli_fetch_array(mysqli_query($conn,"select username from user where active = '1'"))['username'];
        $updatedUsername = $_POST['username'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $updatedPassword = $_POST['newPassword'];
        $updatedAge = $_POST['age'];
        $updatedEmail = $_POST['email'];
        $updatedPhoneNumber = $_POST['phoneNumber'];
        $updatedName = $_POST['name'];
        if($password!==$passwordConfirm){
            $errorMessage = "password must match";
            require_once "profile.php";
        }else{
            $correctPassword = mysqli_fetch_array(mysqli_query($conn,"select password from user where active = '1'"))['password'];
            if($password === $correctPassword){
                if(is_null(mysqli_fetch_array(mysqli_query($conn,"select * from user where username = '$updatedUsername'")))
                ||$username===$updatedUsername){
                    mysqli_query($conn,"update user set 
                    username='$updatedUsername',
                    age='$updatedAge',
                    email = '$updatedEmail',
                    phoneNumber = '$updatedPhoneNumber',
                    name = '$updatedName'
                    where username='$username'");
                    if($updatedPassword!==""){
                        mysqli_query($conn,"update user set password = '$updatedPassword' where username='$updatedUsername'");
                    }
                    require_once "index.php";
                }else{
                    $errorMessage = "username already exists";
                    require_once "profile.php";
                }
            }else {
                $errorMessage = "password is inncorrect";
                require_once "profile.php";
            }
        }
    }
?>