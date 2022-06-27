<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$basename = "mydatabase";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn) {
    die("Database Error!");
}
try{

    $sql = 'CREATE DATABASE mydatabase';
    mysqli_query($conn, $sql);

    $db_selected = mysqli_select_db($conn, $basename);

    $sql = 'CREATE TABLE address(
            addressID number(6) AUTO_INCREMENT primary key,
            street VARCHAR(255),
            houseNumber VARCHAR(255),
            residence VARCHAR(255),
            country VARCHAR(255),
            postCode number(5)
        )';
    mysqli_query($conn, $sql);

    $sql = 'CREATE TABLE user(
            userID number(6)  PRIMARY KEY,
            name VARCHAR(255),
            username VARCHAR(255) UNIQUE,
            password VARCHAR(255),
            email VARCHAR(255),
            phoneNumber VARCHAR(255),
            addressID number,
            active boolean,
            age number,
            FOREIGN KEY (addressID) REFERENCES address(addressID)
        )';
    mysqli_query($conn, $sql);

    $sql = 'CREATE TABLE orders(
            orderID number(6) AUTO_INCREMENT PRIMARY KEY,
            userID number(6),
            orderDate datetime,
            arriveDate datetime,
            state number(20),
            price double(6,2),
            itemCount number,
            FOREIGN KEY (userID) REFERENCES user(userID)
        )';
    mysqli_query($conn, $sql);

    $sql = 'CREATE TABLE pet(
            petID number(6) AUTO_INCREMENT PRIMARY KEY,
            type VARCHAR(255),
            earShape VARCHAR(255),
            eyeColor VARCHAR(255),
            furLength VARCHAR(255),
            furPattern VARCHAR(255),
            baseColor VARCHAR(255),
            alterColor1 VARCHAR(255),
            alterColor2 VARCHAR(255),
            size VARCHAR(20),
            userID number,
            state number,
            price double(6,2),
            orderID number,
            counter number,
            FOREIGN KEY (orderID) REFERENCES orders(orderID),
            FOREIGN KEY (userID) REFERENCES user(userID)
        )';
    mysqli_query($conn, $sql);
    
}catch(Exception $e){
    mysqli_query($conn,'use mydatabase;');
}

?>