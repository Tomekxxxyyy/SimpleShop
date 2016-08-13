<?php
session_start();
$mysqli = mysqli_connect('localhost', 'tomek', '', 'simpleshop');
mysqli_set_charset($mysqli, 'utf8');

$wyswietlany_blok = "<h1>Mój sklep - opis artykułu</h1>";

$pobierz_art_sql = "SELECT kat.id as id_kat, kat.nazwa_kat, art.nazwa_art,"
        . "art.cena_art, art.opis_art, art.foto_art FROM sklep_artykuly AS art LEFT JOIN sklep_kategorie AS kat on kat.id = art.id_kat WHERE art.id = '"
        .$_GET["id_art"]."'";
$pobierz_art_rez = mysqli_query($mysqli, $pobierz_art_sql) or die(mysqli_error($mysqli));

if(mysqli_num_rows($pobierz_art_rez) < 1){
    $wyswietlany_blok .= "<p><em>Wybrano nieistniejący artykuł<em></p>";
}
else{
    while($art_info = mysqli_fetch_array($pobierz_art_rez)){
        $id_kat = $art_info['id_kat'];
        $nazwa_kat = strtoupper(stripslashes($art_info['nazwa_kat']));
        $nazwa_art = stripslashes($art_info['nazwa_art']);
        $cena_art = $art_info['cena_art'];
        $opis_art = stripslashes($art_info['opis_art']);
        $foto_art = $art_info['foto_art'];
    }
    
    $wyswietlany_blok .= "<p><strong><em>Ogladany artykuł:</em><br>"
            . "<a href=zobaczsklep.php?id_kat=".$id_kat.">".$nazwa_kat."</a>&gt;".$nazwa_art."</strong></p>"
            . "<table cellpadding = '3' cellspacing = '3'>"
            . "<tr>"
            . "<td valign = 'middle' align = 'center'>"
            . "<img src = '".$foto_art."'/></td>"
            . "<td valign = 'middle'><p><strong>Opis:</strong><br>"
            . $opis_art
            . "<p><strong>Cena</strong> \$".$cena_art."</p>"
            . "<form method='POST' action='dodajdokoszyka.php'>";
               
    mysqli_free_result($pobierz_art_rez);
    
    $pobierz_kolory_sql = "SELECT art_kolor FROM sklep_art_kolor WHERE id_art = '".$_GET["id_art"]."' ORDER BY art_kolor";
    $pobierz_kolory_rez = mysqli_query($mysqli, $pobierz_kolory_sql) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($pobierz_kolory_rez) > 0){
        $wyswietlany_blok .= "<p><strong>Dostepne kolory</strong></p>"
        ."<select name='kolor_wyb_art'>";
        
        while($kolory = mysqli_fetch_array($pobierz_kolory_rez)){
            $art_kolor = $kolory['art_kolor'];
            $wyswietlany_blok .= "<option value='$art_kolor'>$art_kolor</option>";
        }
        $wyswietlany_blok.="</select>";
    }
    
    mysqli_free_result($pobierz_kolory_rez);
      
    $pobierz_rozmiary_sql = "SELECT art_rozmiar FROM sklep_art_rozmiar WHERE id_art = '".$_GET["id_art"]."'ORDER BY art_rozmiar";
    $pobierz_rozmiary_rez = mysqli_query($mysqli, $pobierz_rozmiary_sql) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($pobierz_rozmiary_rez) > 0){
        $wyswietlany_blok .= "<p><strong>Dostepne rozmiary</strong></p>"
                ."<select name='rozmiar_wyb_art'>";
        while($rozmiary = mysqli_fetch_array($pobierz_rozmiary_rez)){
            $art_rozmiar = $rozmiary['art_rozmiar'];
            $wyswietlany_blok .= "<option value = '$art_rozmiar'>$art_rozmiar</option>";
        }
    }
    
    $wyswietlany_blok .= "</select>";
    
    mysqli_free_result($pobierz_rozmiary_rez);
    
    $wyswietlany_blok .= "<p><strong>Wybierz ilość:</strong>"
            ."<select name = 'ilosc_wyb_art'>";
    for($i=1; $i<11; $i++){
        $wyswietlany_blok .= "<option value = '$i'>$i</option>";
    }
    $wyswietlany_blok .= "</select>"
            ."<input type = 'hidden' name = 'id_wyb_art'"
            ."value = '{$_GET["id_art"]}'>"
            ."<p><input type = 'submit' name = 'submit' value = 'Dodaj do koszyka'></p>"
            ."</form></td></tr></table>";        
}
?>
<!DOCTYPE html>
<html>
<head>
<title>pokazart</title>
<meta charset = "utf-8">
</head>    
<body>
    <?php
        echo $wyswietlany_blok;
    ?>
</body>    
</html>