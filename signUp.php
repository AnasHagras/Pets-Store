<?php
    require_once "dbConfig.php";
    if(isset($_POST['signUp'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordConfirm = $_POST['passwordConfirm'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $phoneNumber = $_POST['phoneNumber'];
        $street = $_POST['street'];
        $houseNumber = $_POST['houseNumber'];
        $residence = $_POST['residence'];
        $country = $_POST['country'];
        $postCode = $_POST['postCode'];
        // check if user already exists 
        if(is_null(mysqli_fetch_array(mysqli_query($conn,"select * from user where username = '$username'")))){
            // check if two passwords match
            if($password==$passwordConfirm){
                // validate the data
                $state = true;
                // check if there is empty input
                foreach($_POST as $ele){
                    $state &= $ele!=="";
                }
                // state >> true || false
                $state &= !preg_match('~[0-9]+~', $name);
                $state &= !preg_match('~[0-9]+~', $street);
                // state >> true || false
                // empty input found 
                if(!$state){
                    $errorMessage = "Invalid Data";
                }
                // no empty input found 
                else{
                    // insert address 
                    $sql = "Insert into address (street , houseNumber , residence,country , postCode) values 
                    ('$street','$houseNumber','$residence' , '$country' , '$postCode')";
                    mysqli_query($conn,$sql);
                    // get auto generated address id 
                    $addressID = mysqli_insert_id($conn);
                    // insert user 
                    $sql = "insert into user (username , name  , password , email , age , phoneNumber , addressID , active) values 
                    ('$username','$name','$password','$email','$age','$phoneNumber','$addressID','1')";
                    mysqli_query($conn,$sql);
                    // nav to home page
                    require_once "index.php";
                    die();
                }
            }else{
                $errorMessage = "Password Must Match!";
            }
        }else{
            $errorMessage = "Username already exists";
        }
    }
?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Build-A-Plush - SignUp</title>
</head>

<body>
    <?php
        require "header.php";
    ?>
    <section>
        <h3>Herzlich Willkommen!</h3>
        <p>Please signup to be able to order plush.</p>
        <form name="signUpForm" id="signUpForm" method="POST" action="signUp.php">
            <p>
                <fieldset>
                    <legend>Grunddaten</legend>
                    <div class="inputGroup">
                        <label for="name">name : </label>
                        <input type="text" name = "name" value=<?php echo isset($name)?$name:""?>>
                    </div>
                    <div class="inputGroup">
                        <label for="username">Username : </label>
                        <input type="text" name = "username" id = "username" value=<?php echo isset($username)&&$username!=="root"?$username:""?>>
                    </div>
                    <div class="inputGroup">
                        <label for="password">Password : </label>
                        <input type="password" name = "password" id = "password" value=<?php echo isset($password)?$password:""?>>
                    </div>
                    <div class="inputGroup">
                        <label for="passwordConfirm">Confirm password : </label>
                        <input type="password" name = "passwordConfirm" id = "passwordConfirm" value=<?php echo isset($passwordConfirm)?$passwordConfirm:""?>>
                    </div>
                    <div class="inputGroup">
                        <label for="age">Age : </label>
                        <input type="number" name = "age" id = "age" value=<?php echo isset($age)?$age:""?>>
                    </div>
                    <div class="inputGroup">
                        <label for="email">Email : </label>
                        <input type="text" name = "email" id = "email" value=<?php echo isset($email)?$email:""?>>
                    </div>
                    <div class="inputGroup">
                        <label for="phoneNumber">PhoneNumber : </label>
                        <input type="text" name = "phoneNumber" id="phoneNumber" value=<?php echo isset($phoneNumber)?$phoneNumber:""?>>
                    </div>
                </fieldset>
            </p>
            <p>
                <fieldset>
                    <legend>Adresse</legend>
                    <div class="inputGroup">
                        <label for="street">Street : </label>
                        <input type="text" name = "street" id="street" value=<?php echo isset($street)?$street:""?>>
                    </div> 
                    <div class="inputGroup">
                        <label for="houseNumber">House Number : </label>
                        <input type="number" name = "houseNumber" id="houseNumber" value=<?php echo isset($houseNumber)?$houseNumber:""?>>
                    </div> 
                    <div class="inputGroup">
                        <label for="residence">Residence : </label>
                        <input type="text" name = "residence" id="residence" value=<?php echo isset($residence)?$residence:""?>>
                    </div> 
                    <div class="inputGroup">
                        <label for="country">Country : </label>
                        <input type="text" name = "country" id="country" value=<?php echo isset($country)?$country:""?>>
                    </div> 
                    <div class="inputGroup">
                        <label for="postCode">Post Code : </label>
                        <input type="number" name = "postCode" id="postCode" value=<?php echo isset($postCode)?$postCode:""?>>
                    </div> 
                </fieldset>
            </p>
            <div class="inputGroup">
                <input type="submit" name = "signUp" id="signUp" value="signUp">
                <input type="reset">
            </div> 
        </form>

        <div class="message">
            <?php
                if(isset($errorMessage)){
                    echo $errorMessage;
                }
            ?>
        </div>

    </section>
    <!-- <footer>
        <ul>
            <li><a>Impressum</a></li>
            <li><a>Datenschutzerklärung</a></li>
            <li><a>Kontakt</a></li>
        </ul>
    </footer> -->
</body>
</html>