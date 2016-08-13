<?php
$mysqli = mysqli_connect('localhost', 'tomek', '', 'simpleshop');
mysqli_set_charset($mysqli, 'utf8');
$wyswietlany_blok = "<h1>Moje kategorie</h1>"
        . "<p>Wybierz kategorię, aby zobaczyć artykuły</p>";
$pobierz_kat_sql = "SELECT id, nazwa_kat, opis_kat FROM sklep_kategorie ORDER BY nazwa_kat";
$pobierz_kat_rez = mysqli_query($mysqli, $pobierz_kat_sql) or die(mysqli_error($mysqli));

if(mysqli_num_rows($pobierz_kat_rez) < 1){
    $wyswietlany_blok = "<p><em>Nie istnieją żadne kategorie.</em></p>";
}
else{
    while($kat = mysqli_fetch_array($pobierz_kat_rez)){
        $id_kat = $kat['id'];
        $nazwa_kat = strtoupper(stripslashes($kat['nazwa_kat']));
        $opis_kat = stripslashes($kat['opis_kat']);
        
        $wyswietlany_blok .= "<p><strong><a href = {$_SERVER["PHP_SELF"]}?id_kat={$id_kat}>{$nazwa_kat}</a></strong></p>";
        
        if(isset($_GET["id_kat"])){
            if($_GET["id_kat"] == $id_kat){
                $get_items_sql = "SELECT id, nazwa_art, cena_art FROM sklep_artykuly WHERE id_kat = '".$id_kat."' ORDER BY nazwa_art";
                $get_items_rez = mysqli_query($mysqli, $get_items_sql)
                        or die(mysqli_error($mysqli));
            
                if(mysqli_num_rows($get_items_rez) < 1){
                    $wyswietlany_blok = "<p><em>Nie ma artykułó w tej kategorii</em></p>";
                }
            
                else{
                    $wyswietlany_blok.= "<ul>";
                    
                    while($items = mysqli_fetch_array($get_items_rez)){
                        $id_art = $items['id'];
                        $nazwa_art = stripslashes($items['nazwa_art']);
                        $cena_art = $items['cena_art'];
                        
                        $wyswietlany_blok .= "<li><a href=pokazart.php?id_art=".$id_art.">".$nazwa_art."</a></li>";
                    }
                    $wyswietlany_blok .= "</ul>";
                }
            }
        }
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>    
<meta charset="utf-8">    
<title>tytuł</title>
</head>
<body>
    <?php echo $wyswietlany_blok; ?>
</body>
</html>


