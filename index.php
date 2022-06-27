<?php

?>
<!DOCTYPE html>
<html lang="de">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Build-A-Plush - Home</title>
</head>

<body>
    <?php 
        require "header.php";
    ?>
    <section>
        <h3>Bau Dein eigenes Plüschtier!</h3>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.Stet clita kasd gubergren, no sea
            takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
            dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <img src="images/Beispielprodukt.jpg" alt="Beispiel" class="beispiel">
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Small</th>
                    <th>Medium</th>
                    <th>Big</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Katze</td>
                    <td>12,00€</td>
                    <td>16,00€</td>
                    <td>20,00€</td>
                </tr>
                <tr>
                    <td>Hund</td>
                    <td>13,00€</td>
                    <td>18,00€</td>
                    <td>22,00€</td>
                </tr>
                <tr>
                    <td>Hase</td>
                    <td>10,00€</td>
                    <td>15,00€</td>
                    <td>18,00€</td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="buildAPlush"><a href="order.php">Order</a></button>
    </section>
    <aside>
        <h4>Neue Plüschtiere kommen!</h4>
        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.Stet clita kasd gubergren, no sea
            takimata sanctus est Lorem ipsum dolor sit amet.</p>
        <p><img src="images/Plüschkatze.jpg" alt="Katze">
            <img src="images/Plüschhund.jpg" alt="Hund">
            <img src="images/Plüschhase.jpg" alt="Hase"></p>
        <button type="button">Weiter</button>
    </aside>
    <?php require_once "footer.php"?>
</body>

</html>