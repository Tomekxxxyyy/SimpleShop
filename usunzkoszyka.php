<?php
session_start();
$mysqli = mysqli_connect('localhost', 'tomek', '', 'simpleshop');

if(isset($_GET["id"])){
    $usun_art_sql = "DELETE FROM sklep_skladklienta WHERE id = '{$_GET["id"]}' AND id_sesji = '{$_COOKIE["PHPSESSID"]}'";
    mysqli_query($mysqli, $usun_art_sql) or die(mysqli_error($mysqli));
    
    header("Location: pokazkoszyk.php");
    exit();
}
else{
    header("Location: zobaczsklep.php");
    exit();
}
?>
