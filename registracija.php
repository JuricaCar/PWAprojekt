<?php

$servername= "localhost";
$username= "root";
$password= "";
$basename= "news";

$dbc = mysqli_connect($servername, $username, $password, $basename) or 
die("Error connecting to MySQL server." . mysqli_connect_error());




?>

<html>
<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="unosstyle.css" />
    <title>Unos forme</title>
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
        <div class="forma">
            <form enctype="multipart/form-data" method="post" action="" class="izgledforme">

                <span id="porukaIme"class="bojaPoruke"></span>
                <label for="ime">Ime:</label>
                <br /><br />

                <input name="ime" id="ime" type="text"/>
                <br /><br />

                <span id="porukaPrezime"class="bojaPoruke"></span>
                <label for="prezime">Prezime: </label>
                <br /><br />

                <input name="prezime" id="prezime" type="text"/>
                <br /><br />

                <span id="porukaUsername"class="bojaPoruke"></span>
                <label for="username">Korisničko ime: </label>
                <br><br>

                <input name = "username" id="username" type="text" />
                <br><br>

                <span id="porukaPass"class="bojaPoruke"></span>
                <label for="pass">Lozinka: </label>
                <br><br>
                
                <input name = "pass" id="pass" type="password" />
                <br><br>

                <span id="porukaPassRep"class="bojaPoruke"></span>
                <label for="passRep">Ponovite Lozinku: </label>
                <br><br>
                
                <input name = "passRep" id="passRep" type="password" />
                <br><br>
                
                
                <br /><br /><br />

                <input name="submit" type="submit" id="submit" value="Posalji" />
                <br />
                <br />

                <?php

                if (isset($_POST['ime'])) {
                    $ime = $_POST['ime'];
                }

                if (isset($_POST['prezime'])) {
                    $prezime = $_POST['prezime'];
                }

                if (isset($_POST['username'])) {
                    $username = $_POST['username'];
                }

                if (isset($_POST['pass'])) {
                    $lozinka = $_POST['pass'];
                } else {
                    $lozinka = '';
                }





                //$ime= $_POST['ime'];
                //$prezime= $_POST['prezime'];
                //$username= $_POST['username'];
                //$lozinka= $_POST['pass'];
                $hashed_password= password_hash($lozinka, CRYPT_BLOWFISH);
                $razina= 0;
                $registriranKorisnik= '';


                $sql= "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime =?";
                $stmt= mysqli_stmt_init($dbc);

                if(mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 's', $username);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }


                if(mysqli_stmt_num_rows($stmt) > 0) {
                    echo 'Korisničko ime već postoji!';
                } else {

                    // Ako username nije zauzet dolazi do registracije korisnika pazeći na SQL injection

                    $sql= "INSERT INTO korisnik (ime, prezime, korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
                    $stmt= mysqli_stmt_init($dbc);

                    if(mysqli_stmt_prepare($stmt, $sql)) {
                        mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
                        mysqli_stmt_execute($stmt);
                        $registriranKorisnik= true;
                    }

                    if($registriranKorisnik == true) {
                        echo '<p>Korisnik je uspješno registriran!</p>';
                    }


                }


                ?>

            </form>
            
            <script type="text/javascript">
            // Validacija pomoću JavaScripta

                document.getElementById("submit").onclick= function(event) {
                    var slanjeForme = true;

                    // Validacija imena korisnika (Mora biti uneseno)
                    var poljeIme= document.getElementById("ime");
                    var ime= document.getElementById("ime").value;
                    if(ime.length== 0) {
                        slanjeForme= false;
                        poljeIme.style.border="1px dashed red";
                        document.getElementById("porukaIme").innerHTML="Unesite ime!<br>";
                    } else {
                        poljeIme.style.border="1px solid green";
                        document.getElementById("porukaIme").innerHTML="";
                        }
                    
                    // Validacija prezimena korisnika (Mora biti uneseno)
                    var poljePrezime= document.getElementById("prezime");
                    var prezime= document.getElementById("prezime").value;
                    if(prezime.length== 0) {
                        slanjeForme= false;
                        poljePrezime.style.border="1px dashed red";
                        document.getElementById("porukaPrezime").innerHTML="Unesite prezime!<br>";
                    } else {
                        poljePrezime.style.border="1px solid green";
                        document.getElementById("porukaPrezime").innerHTML="";
                    }

                    // Validacija korisničkog imena (Mora biti unesen)
                    var poljeUsername= document.getElementById("username");
                    var username= document.getElementById("username").value;
                    if(username.length == 0) {
                        slanjeForme= false;
                        poljeUsername.style.border="1px dashed red";
                        document.getElementById("porukaUsername").innerHTML="Unesite korisničko ime!<br> ";
                    } else {
                        poljeUsername.style.border="1px solid green";
                        document.getElementById("porukaUsername").innerHTML="";
                    }

                    // Validacija lozinke (Moraju se podudarat i moraju biti unesene)
                    var poljePass= document.getElementById("pass");
                    var pass= document.getElementById("pass").value;
                    var poljePassRep= document.getElementById("passRep");
                    var passRep= document.getElementById("passRep").value;
                    if(pass.length== 0|| passRep.length== 0|| pass!= passRep) {
                        slanjeForme= false;
                        poljePass.style.border="1px dashed red";
                        poljePassRep.style.border="1px dashed red";
                        document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
                        document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
                    } else {
                        poljePass.style.border="1px solid green";
                        poljePassRep.style.border="1px solid green";
                        document.getElementById("porukaPass").innerHTML="";
                        document.getElementById("porukaPassRep").innerHTML="";
                    }


                    if (slanjeForme != true) {
                        event.preventDefault();
                    }
                };
            </script>
        </div>
    </div>
    <div class="footer">
        <footer>
            <p class="copyright">Copyright 2019 Morgenpost Verlag GmbH</p>
        </footer>
    </div>
</body>
</html>


