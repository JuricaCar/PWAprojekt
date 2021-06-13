<?php
include 'connect.php';
define('UPLPATH', 'images/');
session_start();

//Spajanje na bazu korisnik

$servername= "localhost";
$username= "root";
$password= "";
$basename= "news";

$dbc = mysqli_connect($servername, $username, $password, $basename) or 
die("Error connecting to MySQL server." . mysqli_connect_error());


//Gumb brisanje

if(isset($_POST['delete'])) {
    $id=$_POST['id'];
    $query= "DELETE FROM news WHERE id=$id";
    $result= mysqli_query($dbc, $query);
}

//Gumb izmjeni

if(isset($_POST['update'])) {
$photo = $_FILES['pphoto'] ["name"];
$naslovVijesti = $_POST['naslovvijesti'];
$kratakSadrzajVijesti = $_POST['krataksadrzajvijesti'];
$sadrzajVijesti = $_POST['sadrzajvijesti'];
$kategorijaVijesti = $_POST['kategorijavijesti'];
if(isset($_POST['obavijestda'])) {
    $archive = 1;
} else {
    $archive = 0;
}


$target_dir= 'images/'.$photo;
move_uploaded_file($_FILES['pphoto']["name"], $target_dir);

$id=$_POST['id'];
$query= "UPDATE news SET naslov='$naslovVijesti', sazetak='$kratakSadrzajVijesti', sadrzaj='$sadrzajVijesti', slika='$photo', kategorija='$kategorijaVijesti', arhiva='$archive' WHERE id=$id";
$result= mysqli_query($dbc, $query);
}


?>

<!DOCTYPE html>
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

            <?php
            if(isset($_POST['submit'])) {
                $prijavaImeKorisnika= $_POST['username'];
                $prijavaLozinkaKorisnika= $_POST['pass'];
                $sql= "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime =?";
                $stmt= mysqli_stmt_init($dbc);
                if(mysqli_stmt_prepare($stmt, $sql)) {
                    mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                }
                mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
                mysqli_stmt_fetch($stmt);

                if(password_verify($_POST['pass'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
                    $uspjesnaPrijava= true;

                    if ($levelKorisnika == 1) {
                        $admin= true;
                    } else {
                        $admin= false;
                    }
                    $_SESSION['$username'] = $imeKorisnika;
                    $_SESSION['$level'] = $levelKorisnika;

                } else {

                    $admin = false;
                    $uspjesnaPrijava= false;
                }
            }

            if((isset($uspjesnaPrijava) == true && $admin == true) || (isset($_SESSION['$username'])) && $_SESSION['$level'] == 1) {

            

                $query = "SELECT * FROM news";
                $result = mysqli_query($dbc, $query);

                if ($result) {
                    while($row= mysqli_fetch_array($result)) {
                        echo'<form enctype = "multipart/form-data" action ="" method="POST">
                            <div class="form-item">
                                <label for="naslovvijesti">Naslov Vijesti</label>
                                <br><br>
                            <div class="form-field">
                                <input type="text" name="naslovvijesti" class="form-field-textual" value="'.$row['naslov'].'">
                                <br><br>
                                </div>
                                </div>
                                <div class = "form-item">
                                    <label for="krataksadrzajvijesti">Kratki sažetak vijesti</label>
                                    <br><br>
                                <div class="form-field">
                                    <textarea name="krataksadrzajvijesti" class="form-field-textual">'.$row['sazetak'].'</textarea>
                                    <br><br>
                                </div>
                                </div>
                                <div class = "form-item">
                                    <label for="sadrzajvijesti">Sadržaj vijesti</label>
                                    <br><br>
                                <div class="form-field">
                                    <textarea name="sadrzajvijesti" class="form-field-textual">'.$row['sadrzaj'].'</textarea>
                                    <br><br>
                                </div>
                                </div>
                                <div class="form-item">
                                    <label for="pphoto">Slika: </label>
                                    <br><br>
                                <div class="form-field">
                                    <input type="file" class="input-text" value="'.$row['slika'].'" name="pphoto"/> <br><br><img src="'. UPLPATH . $row['slika'] . '" width=100px>
                                    <br><br>
                                </div>
                                </div>
                                <div class="form-item">
                                <label for="kategorijavijesti">Odaberi kategoriju vijesti</label>
                                <br><br>
                                <div class="form-field">
                                    <select name="kategorijavijesti" class="form-field-textual" value="'.$row['kategorija'].'">
                                        <option value="Sport">Sport</option>
                                        <option value="Politika">Politika</option>
                                    </select>
                                    <br><br>
                                </div>
                                </div>
                                <div class="form-item">
                                    <label for ="obavijestda">Spremiti u arhivu:</label>
                                    <br><br>
                                <div class="form-field">';
                                    if($row['arhiva'] == 0) {
                                        echo'<input type="checkbox" name="obavijestda" id="archive"/>Arhiviraj?';
                                    } else {
                                        echo'<input type="checkbox" name="obavijestda" id="archive"checked/> Arhiviraj?';
                                    }
                                    echo '</div>
                                    </div>
                                    <div class="form-item">
                                    <br><br>
                                        <input type="hidden" name="id" class="form-field-textual"value="'.$row['id'].'">
                                        <button type="reset" value="Poništi">Poništi</button>
                                        <button type="submit" name="update" value="Prihvati">Izmjeni</button>
                                        <button type="submit" name="delete" value="Izbriši">Izbriši</button>
                                        <br><br><br><br><br><br><br><br>
                                    </div>
                                </form>';


                    }
                }
            } else if (isset($uspjesnaPrijava) && $uspjesnaPrijava == true&& $admin== false) {
                echo'<p>Bok '. $imeKorisnika. '! Uspješno ste prijavljeni, ali niste administrator.</p>';
            } else if (isset($_SESSION['$username']) && $_SESSION['$level'] == 0) {
                echo'<p>Bok '. $_SESSION['$username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
            } else if (isset($uspjesnaPrijava) == false) {

                echo '<form enctype = "multipart/form-data" action ="" method="POST">
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

                <br /><br /><br />

                <input name="submit" type="submit" id="submit" value="Posalji" />
                </form>';


                echo '<script type="text/javascript">
                document.getElementById("submit").onclick= function(event) {
                    var slanjeForme = true;

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

                    var poljePass= document.getElementById("pass");
                    var pass = document.getElementById("pass").value;
                    if(pass.length == 0) {
                        slanjeForme= false;
                        poljePass.style.border="1px dashed red";
                        document.getElementById("porukaPass").innerHTML="Unesite lozinku!<br> ";
                    } else {
                        poljePass.style.border="1px solid green";
                        document.getElementById("porukaPass").innerHTML="";
                    }



                    if (slanjeForme != true) {
                        event.preventDefault();
                    }

                }
                </script>';


                
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