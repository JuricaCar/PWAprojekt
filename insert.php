<?php

include 'connect.php';

if (isset($_POST['naslovvijesti'])) {
    $naslovVijesti = $_POST['naslovvijesti'];
} else {
    $naslovVijesti == "Niste upisali naslov vijesti!";
}

if (isset($_POST['obavijestda'])) {
    $obavijest = 1;
} else {
    $obavijest = 0;
}






$naslovVijesti = $_POST['naslovvijesti'];
$kratakSadrzajVijesti = $_POST['krataksadrzajvijesti'];
$sadrzajVijesti = $_POST['sadrzajvijesti'];
$kategorijaVijesti = $_POST['kategorijavijesti'];
$photo = $_POST['pphoto'];



    $target_dir= 'images/'.$photo;
    move_uploaded_file(isset($_FILES['pphoto']), $target_dir);




$query= "INSERT INTO news (naslov, sazetak, sadrzaj, slika, kategorija, arhiva ) 
VALUES('$naslovVijesti', '$kratakSadrzajVijesti', '$sadrzajVijesti', '$photo', '$kategorijaVijesti', '$obavijest')";

$result= mysqli_query($dbc, $query) or die('Error querying databese.');



?>