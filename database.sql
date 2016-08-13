CREATE DATABASE simpleshop DEFAULT CHARACTER SET utf8;

CREATE TABLE sklep_kategorie(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nazwa_kat VARCHAR(50) UNIQUE,
    opis_kat TEXT
);

CREATE TABLE sklep_artykuly(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_kat INT NOT NULL,
    nazwa_art VARCHAR(75),
    cena_art FLOAT(8,2),
    opis_art TEXT,
    foto_art VARCHAR(50)
);

CREATE TABLE sklep_art_rozmiar(
    id_art INT NOT NULL,
    art_rozmiar VARCHAR(25)
);

CREATE TABLE sklep_art_kolor(
    id_art INT NOT NULL,
    art_kolor VARCHAR(25)
);

INSERT INTO sklep_kategorie VALUES(NULL, 'Czapki', 'Wystrzałowe czapki we wszystkich kształtach i rozmiarach');
INSERT INTO sklep_kategorie VALUES(NULL, 'Koszulki', 'T_Shirty, polo, bluzy i inne');
INSERT INTO sklep_kategorie VALUES(NULL, 'Książki', 'W miękkich i w twardych oprawach, książki do szkoły i dla rozrywki');

INSERT INTO sklep_artykuly VALUES(NULL, 1, 'czapka bejsbolowa', 12.00, 'Modna, niskoprofilowa czapka bejsbolowa', 'czapkabejsb.gif');
INSERT INTO sklep_artykuly VALUES(NULL, 1, 'kapelusz kowbojski', 52.00, 'W stylu teksańskim', 'kapelowkowb.gif');
INSERT INTO sklep_artykuly VALUES(NULL, 1, 'Cylinder', 102.00, 'Idealny na bal przebierańców', 'cylinder.gif');

INSERT INTO sklep_artykuly VALUES(NULL, 2, 'T-shirt z krótkim rękawem', 12.00, '100% bawełny, materiał niezstępujący się', 'tshirt_kr.gif');
INSERT INTO sklep_artykuly VALUES(NULL, 2, 'T-shirt z długim rękawem', 15.00, 'Wygląda jak t-shirt z krótkim rękawem ale ma długi rękaw', 'tshirt_dr.gif');
INSERT INTO sklep_artykuly VALUES(NULL, 2, 'Bluza', 22.00, 'Gruba i ciepła', 'bluza.gif');

INSERT INTO sklep_artykuly VALUES(NULL, 3, 'Z janiną pomożesz sobie sam', 12.00, 'janina radzi', 'janinaradzi.gif');
INSERT INTO sklep_artykuly VALUES(NULL, 3, 'Podręcznik akademicki', 35.00, 'lektury obowizkowe dla studenta', 'nudnaksiazka.gif');
INSERT INTO sklep_artykuly VALUES(NULL, 3, 'Styl w pisaniu', 9.99, 'Gratka dla copywriterow', 'stylwpis.gif');

INSERT INTO sklep_art_rozmiar VALUES(1, 'rozmiar uniwersalny');
INSERT INTO sklep_art_rozmiar VALUES(2, 'rozmiar uniwersalny');
INSERT INTO sklep_art_rozmiar VALUES(3, 'rozmiar uniwersalny');
INSERT INTO sklep_art_rozmiar VALUES(4, 'S');
INSERT INTO sklep_art_rozmiar VALUES(4, 'M');
INSERT INTO sklep_art_rozmiar VALUES(4, 'L');
INSERT INTO sklep_art_rozmiar VALUES(4, 'XL');

INSERT INTO sklep_art_kolor VALUES(1, 'czerwony');
INSERT INTO sklep_art_kolor VALUES(1, 'czarny');
INSERT INTO sklep_art_kolor VALUES(1, 'niebieski');

--druga część

CREATE TABLE sklep_skladklienta(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_sesji VARCHAR(32),
    id_wyb_art INT,
    ilosc_wyb_art SMALLINT,
    rozmiar_wyb_art VARCHAR(25),
    kolor_wyb_art VARCHAR(25),
    data_dodania DATETIME
);

CREATE TABLE sklep_zamowienia(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    data_zam DATETIME,
    nazwa_zam VARCHAR(100),
    adres_zam VARCHAR(255),
    miasto_zam VARCHAR(50),
    woj_zam VARCHAR(20),
    kod_zam VARCHAR(6),
    tel_zam VARCHAR(25),
    email_zam VARCHAR(100),
    art_suma FLOAT(6,2),
    dostawa_suma FLOAT(6,2),
    autoryzacja VARCHAR(50),
    stan ENUM('zrealizowane', 'oczekujace')
);

CREATE TABLE sklep_zam_art(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_zam INT,
    id_wyb_art INT,
    ilosc_wyb_art SMALLINT,
    rozmiar_wyb_art VARCHAR(25),
    kolor_wyb_art VARCHAR(25),
    cena_wyb_art FLOAT(6,2)
);