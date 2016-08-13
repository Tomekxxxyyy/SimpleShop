<?php
session_start();

$mysqli = mysqli_connect('localhost', 'tomek', '', 'simpleshop');
mysqli_set_charset($mysqli, 'utf8');

if(isset($_POST["id_wyb_art"])){
    $pobierz_artinfo_sql = "SELECT nazwa_art FROM sklep_artykuly WHERE id = '".$_POST["id_wyb_art"]."'";
    $pobierz_artinfo_rez = mysqli_query($mysqli, $pobierz_artinfo_sql);
    if(mysqli_num_rows($pobierz_artinfo_rez) < 1){
        header("Location: zobaczsklep.php");
        exit();
    }
    $dodajdokosz_sql = "INSERT INTO sklep_skladklienta(id_sesji, id_wyb_art, ilosc_wyb_art, rozmiar_wyb_art,"
            ."kolor_wyb_art, data_dodania) VALUES('".$_COOKIE["PHPSESSID"]."','".$_POST["id_wyb_art"]."','".$_POST["ilosc_wyb_art"]
            ."','".$_POST["rozmiar_wyb_art"]."','".$_POST["kolor_wyb_art"]."', now())";
    mysqli_query($mysqli, $dodajdokosz_sql) or die(mysqli_error($mysqli));
    
    header("Location: pokazkoszyk.php");
    exit();
}
else{
    header("Location: zaobaczsklep.php");
    exit();
}
?>