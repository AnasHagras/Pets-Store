<?php 
    require_once "dbConfig.php";
?>
<header>
    <h2><a href="index.php">Plushies R Us</a></h2>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a>Über uns</a></li>
            <li><a href="order.php">Make Order</a></li>
            <li><a>Kontakt</a></li>
            <li><a href="chart.php">My Chart</a></li>
            <li><a href="myOrders.php">Order History</a></li>
            <li><a href=<?php
                $sql = "select * from user where active = '1'";
                $result = mysqli_query($conn,$sql);
                $data = mysqli_fetch_array($result);
                if(isset($data['username'])){
                    echo "profile.php";
                }else {
                    echo "login.php";
                }
            ?>>
                <?php 
                if(isset($data['name'])){
                    echo $data['name'];
                }else {
                    echo "login";
                }?>
                </a>
            </li>
        </ul>
    </nav>
    <p><img src="images/Banner.jpg" alt="Banner"></p>
</header>