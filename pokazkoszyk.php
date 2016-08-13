<?php
session_start();

$mysqli = mysqli_connect("localhost", "tomek", "", "simpleshop");
mysqli_set_charset($mysqli, 'utf8');
$wyswietlany_blok = "<h1>Zawartość twojego koszyka</h1>";

$pobierz_koszyk_sql = "SELECT st.id, si.nazwa_art, si.cena_art, st.ilosc_wyb_art, st.rozmiar_wyb_art, "
        . "st.kolor_wyb_art FROM sklep_skladklienta AS st LEFT JOIN sklep_artykuly AS si ON si.id = st.id_wyb_art "
        . "WHERE id_sesji = '{$_COOKIE["PHPSESSID"]}'";
        
$pobierz_koszyk_rez = mysqli_query($mysqli, $pobierz_koszyk_sql) or die(mysqli_error($mysqli));
if(mysqli_num_rows($pobierz_koszyk_rez) < 1){
    $wyswietlany_blok .= "<p>Koszyk jest pusty. <a href = 'zobaczsklep.php'>przejdź do sklepu</a>!</p>";
}
else{
    $wyswietlany_blok .= "<table cellpadding = '3' cellspacing = '2' border = '1' width = '98%'>"
            . "<tr>"
            . "<th>Nazwa</th>"
            . "<th>Rozmiar</th>"
            . "<th>Kolor</th>"
            . "<th>Cena</th>"
            . "<th>Ilośc</th>"
            . "<th>Suma</th>"
            . "<th>Akcja</th>"
            . "</tr>";
    
    while($koszyk_info = mysqli_fetch_array($pobierz_koszyk_rez)){
        $id = $koszyk_info["id"];
        $nazwa_art = stripslashes($koszyk_info["nazwa_art"]);
        $cena_art = $koszyk_info["cena_art"];
        $ilosc_art = $koszyk_info["ilosc_wyb_art"];
        $art_kolor = $koszyk_info["kolor_wyb_art"];
        $art_rozmiar = $koszyk_info["rozmiar_wyb_art"];
        $suma = sprintf("%.02f", $cena_art * $ilosc_art);
        
        $wyswietlany_blok .= "<tr><td align = 'center'>$nazwa_art<br></td>"
                . "<td align = 'center'>$art_rozmiar<br></td>"
                . "<td align = 'center'>$art_kolor<br></td>"
                . "<td align = 'center'>\$ $cena_art<br></td>"
                . "<td align = 'center'>$ilosc_art<br></td>"
                . "<td align = 'center'>$suma</td>"
                . "<td align = 'center'><a href = 'usunzkoszyka.php?id={$id}'>usuń</a></tr>";
    }
    
    $wyswietlany_blok .= "</table>";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Mój sklep</title>
    <meta charset = "utf-8">
</head>
<body>
    <?php echo "$wyswietlany_blok";?>
</body>
</html>