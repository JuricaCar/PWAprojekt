<?php

include 'connect.php';
include 'insert.php'
?>
<link rel="stylesheet" type="text/css" href="articlestyle.css" />

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
        <div class="tekst">
            <h1><?php echo $kategorijaVijesti?></h1>
            <br>
            <br>
            <h2><?php echo $naslovVijesti?></h2>
            <?php echo"<img src='images/$photo' class= 'img-upload'"; ?>
            <br>
            <p><?php echo $kratakSadrzajVijesti ?></p>
            <br>
            <br>
            <p><?php echo $sadrzajVijesti ?></p>
        </div>
    </div>
    <div class="footer">
        <footer>
            <p class="copyright">Copyright 2019 Morgenpost Verlag GmbH</p>
        </footer>
    </div>
