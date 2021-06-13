<?php
include 'connect.php';
define('UPLPATH', 'images/');

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="articlestyle.css" />
    <title>Article</title>
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
    <hr>
    <div class="main">
        <div class="artikl">
            <?php
            $id = $_GET['id'];
            $query = "SELECT * FROM news WHERE id = '$id' LIMIT 1";
            $result = mysqli_query($dbc, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                    echo "<h1>".$row['naslov']."</h1>";
            }
            ?>  
        </div>
        <div class="datum">
            <img src="images/clock.png" class="img-clock">
            <p class="date">08.06.2021</p>
        </div>
        <div class="slika">
            <?php
            echo '<img src="'. UPLPATH . $row['slika'] . '" class="img-artiklopened">';
            ?>
        </div>
        <div class="tekst">
            <?php
            echo '<p>' .$row["sazetak"].'</p>';
            ?>
            <br>
            <?php
            echo '<p>' .$row["sadrzaj"].'</p>';
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