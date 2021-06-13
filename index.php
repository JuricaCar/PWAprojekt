<?php
include 'connect.php';
define('UPLPATH', 'images/');

?>



<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <title>Hamburger Morgenpost</title>
</head>
<body>
    <nav class="navigation">
        <ul class="list">
            <li class="logo">
                <img src="images/logo.png" class="img-fluid">
            </li>
            <li id="list_item1" class="listItem ListItem1"><a class="red" href="index.php">HOME</a></li>
            <li id="list_item2" class="listItem"><a class="white" href="unos.html">FORMA</a></li>
            <li id="list_item3" class="listItem"><a class="white" href="kategorija.php?id=Sport">SPORT</a></li>
            <li id="list_item4" class="listItem"><a class="white" href="kategorija.php?id=Politika">POLITIKA</a></li>
            <li id="list_item5" class="listItem"><a class="white" href="administracija.php">ADMINISTRACIJA</a></li>
            <li id="list_item6" class="listItem"><a class="white" href="registracija.php">REGISTRACIJA</a></li>
        </ul>
    </nav>
    <div class="main">
        <div class="prviNews">
            <h1>Sport</h1>
            <hr>
            <?php

            $query = "SELECT * FROM news WHERE arhiva = 0 AND kategorija = 'Sport' LIMIT 3";
            $result = mysqli_query($dbc, $query);

            if ($result) {
                while($row = mysqli_fetch_array($result)) {
                    echo '<a href="artikl.php?id='.$row['id'].'">';
                    echo '<div class="artikl">';
                        echo '<img src="'. UPLPATH . $row['slika'] . '" class="img-artikl">';
                        echo '<p>' .$row["naslov"].'</p>';
                    echo '</div>';
                    echo '</a>';
                }
            }
            ?>
        </div>
        <div class="drugiNews">
            <br>
            <h1>Politika</h1>
            <hr>
            <?php

            $query = "SELECT * FROM news WHERE arhiva = 0 AND kategorija = 'Politika' LIMIT 3";
            $result = mysqli_query($dbc, $query);

            if ($result) {
                while($row = mysqli_fetch_array($result)) {
                    echo '<a href="artikl.php?id='.$row['id'].'">';
                    echo '<div class="artikl">';
                        echo '<img src="'. UPLPATH . $row['slika'] . '" class="img-artikl">';
                        echo '<p>' .$row["naslov"].'</p>';
                    echo '</div>';
                    echo '</a>';
            }
        }
        ?>
        </div>
    </div>
    <div class="footer">
        <footer>
            <p class="copyright">Copyright 2019 Morgenpost Verlag GmbH</p>
        </footer>
    </div>
</body>

</html>