<?php
    require_once "dbConfig.php";
    if(isset($_POST['order'])){
        $currentUser = @mysqli_fetch_array(mysqli_query($conn,"select userID from user where active='1'"))['userID'];
        if(is_null($currentUser)){
            $errorMessage = "please login to be able to make order";
        }else{
            // get the data
            $type = $_POST['type'];
            $earShape = $_POST['earShape'];
            $eyeColor = $_POST['eyeColor'];
            $furLength = $_POST['furLength'];
            $furPattern = $_POST['furPattern'];
            $baseColor = $_POST['baseColor'];
            $alterColor1 = $_POST['alternativeColor1'];
            $alterColor2 = $_POST['alternativeColor2'];
            $size = $_POST['size'];
            $paymentMethod = $_POST['payment'];
            $price = $_POST['price'];
            $sql = "INSERT INTO pet (type , earShape , eyeColor , furLength , furPattern , baseColor , alterColor1,alterColor2 , size , price , userID, state,counter)
            values ('$type','$earShape','$eyeColor','$furLength','$furPattern','$baseColor','$alterColor1','$alterColor2','$size','$price','$currentUser',-1,1)";
            mysqli_query($conn,$sql);
            $errorMessage = "item added to chart";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Make Order</title>
    <script>
        window.addEventListener("DOMContentLoaded",()=>{
            function changePrice (){
                var type = document.querySelector("#type").selectedOptions[0].value;
                var size = document.querySelector("#size").selectedOptions[0].value;
                var hiddenPrice = document.querySelector("#price");
                if(type==='cat'){
                    if(size==='small'){
                        document.querySelector("#priceSpan").innerHTML = "12.00 ";
                        hiddenPrice.value = "12.00";
                    }else if (size ==='medium'){
                        document.querySelector("#priceSpan").innerHTML = "16.00 ";
                        hiddenPrice.value = "16.00";
                    }else {
                        document.querySelector("#priceSpan").innerHTML = "20.00 ";
                        hiddenPrice.value = "20.00";
                    }
                }else if (type==='dog'){
                    if(size==='small'){
                        document.querySelector("#priceSpan").innerHTML = "13.00 ";
                        hiddenPrice.value = "13.00";
                    }else if (size ==='medium'){
                        document.querySelector("#priceSpan").innerHTML = "18.00 ";
                        hiddenPrice.value = "18.00";
                    }else {
                        document.querySelector("#priceSpan").innerHTML = "22.00 ";
                        hiddenPrice.value = "22.00";
                    }
                }else {
                    if(size==='small'){
                        document.querySelector("#priceSpan").innerHTML = "10.00 ";
                        hiddenPrice.value = "10.00";
                    }else if (size ==='medium'){
                        document.querySelector("#priceSpan").innerHTML = "15.00 ";
                        hiddenPrice.value = "15.00";
                    }else {
                        document.querySelector("#priceSpan").innerHTML = "18.00 ";
                        hiddenPrice.value = "18.00";
                    }
                }
            }
            document.querySelector("#type").addEventListener("click",changePrice);
            document.querySelector("#size").addEventListener("click",changePrice);
        });
    </script>
    <!-- handle price with java script -->
</head>
<body>
    <?php
        require "header.php";
    ?>
    <section>
        <h3>Bau Dein eigenes Plüschtier!</h3>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt.</p>
        <p><img src="images/Beispielprodukt.jpg" alt="Beispiel" class="beispiel"><br><form id="order" name="order" method="POST" action="order.php">
            <p><fieldset>
                <legend>Type</legend>
                <label for="type">Choose a type:</label>
                <select name="type" id="type">
                    <option value="Cat" name="cat">Cat</option>
                    <option value="Dog" name="dog">Dog</option>
                    <option value="Rabbit" name="rabbit">Rabbit</option>
                </select>
            </fieldset></p>
            <p><fieldset>
                <legend>Ear Shape</legend>
                <label for="earShape">Choose Ear Shape:</label>
                <select name="earShape" id="earShape" >
                    <option value="Straight" name="straight">Straight</option>
                    <option value="Folded" name="folded">Folded</option>
                </select>
            </fieldset></p>
            <p><fieldset>
                <legend>Eye Color</legend>
                <label for="eyeColor">Choose Eye Color : </label>
                <input type="color" id="eyeColor" name="eyeColor"><br>
            </fieldset></p>
            <p><fieldset>
                <legend>Fur Length</legend>
                <label for="furLength">Choose Fur Length:</label>
                <select name="furLength" id="furLength">
                    <option value="Short" name="short">Short</option>
                    <option value="Long" name="long">Long</option>
                </select>
            </fieldset></p>
            <p><fieldset>
                <legend>Fur Pattern</legend>
                <label for="furPattern">Choose Fur Pattern:</label>
                <select name="furPattern" id="furPattern">
                    <option value="Monochrome" name="monochrome">Monochrome</option>
                    <option value="Striped" name="striped">Striped</option>
                    <option value="TwoColors" name="twoColors">Spotted in two colors</option>
                    <option value="ThreeColors" name="threeColors">Spotted in three colors</option>
                </select>
                <br>
                <label for="baseColor">Base Color : </label>
                <input type="color" id="baseColor" name="baseColor"><br>
                <label for="alternativeColor1">Alternative Color 1 : </label>
                <input type="color" id="alternativeColor1" name="alternativeColor1"><br>
                <label for="alternativeColor2">Alternative Color 2 : </label>
                <input type="color" id="alternativeColor2" name="alternativeColor2"><br>
            </fieldset></p>
            <p><fieldset>
                <legend>Size</legend>
                <label for="size">Choose Size:</label>
                <select name="size" id="size">
                    <option value="Small" name="small">Small</option>
                    <option value="Medium" name="medium">Medium</option>
                    <option value="Big" name="big">Big</option>
                </select>
            </fieldset></p>
            <p><fieldset>
                <legend>Payment Method</legend>
                <label for="payment">Choose Payment Method:</label>
                <select name="payment" id="payment">
                    <option value="cash" name="cash">Cash</option>
                </select>
            </fieldset></p>
            <input type="hidden" name = "price" id = "price" value="12.00">
            <div >Order Price Is : <span id="priceSpan">12.00 </span><span>€</span></div><br>
            <input type="submit" name = 'order' value="Add To Chart"><br>
        </form></p>
        <div class="message"><?php echo isset($errorMessage)?$errorMessage:""?></div>
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