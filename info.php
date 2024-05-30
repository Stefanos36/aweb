<?php
//dam iba co to obsahuje
require("connection.php");
require("functions.php");
require("sessionconfig.php");
include("header.php");
headerdb();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-icons.css">
        <script src="odhlasenie.js"></script>
</head>
<body>
    <!-- style="height:50%" -->
<div class="blogpost" >
        <div class="blogobsah" style="background-color: #2d2f33;">
            <h2>Táto stránka je školský projekt </h2>
            <p>Tento výtvor slúži ako bakalárska práca, ukázanie dovedností nadobudnuté počas štúdia <a href="https://www.fei.stuba.sk/" target="_blank">FEI STU</a>.
             <br>Autorom je hádam budúci bakalár Štefan Fischer
            <br>Vedúci práce:	Ing. Peter Minarovský </p>
            <br>
            
            <h2>Funkcionality</h2>
           
            <p>Cieľom bolo vytvoriť stránku s honeypot-om. Honeypot je zaznamenávací systém na nekalú aktivitu.
                V tomto projekte je implementovaný skritými vyplňovacími dotazníkmi. Zaznamenával sa na ňom rozkliknutá url, zadaný vstup, čas vytvorenia, ip adresa.
               <br ><br> <a href="honeypotlog.php" class="button">honeypot log</a>
                <br><br>
                Stránka dostala podobu diskusného fóra, kde užívatelia môžu spolu komunikovať. Fóra sú vytvárané dynamicky - údaje sú načítané z 
                sql databázy. Parameter podľa ktorého sa určí ktoré fórum sa vyberá je pomocou vytvoreného get request-u.  
                <br><br>Bol vytvorený vlastný systém pre registráciu užívateľov. Používal sa princíp hashovania hesiel zo soľou. 
            </p>
            <h2>Vysvetlívky ku stránke</h2>
            <p>Úvodná stránka index.php vás pristane na zoznam vytvorených chatovacích blogov. Sú zoradené od najnovšieho po najstaršie.</p>
            <img src="images\home2.png" alt="" class="imgopis" >
            <p>Ukážka pre mobilné verzie.</p>
            <img src="images\mobil2.png" alt="" class="imgopis"  >
            <p>Keď sa rokliknete do fóra.</p>
            <img src="images\blog2.png" alt="" class="imgopis"  >
            <p>Registračný formulár vyžaduje zadať meno a heslo. Meno - Username je unikátne pre každého používateľa s max 25 znakmi. Heslo má max 40 znakov.
                Ku každému heslu sa vygeneruje soľ - súhrn náhodných znakov a po spojení prejde hashom.   </p>
            <img src="images\signup.png" alt="" class="imgopis"  >

            <p>Prihlasovací formulár, po správnom prihlásení vás presmeruje na úvodnú stránku.</p>
            <img src="images\login.png" alt="" class="imgopis"  >       
            <p>Prihlásenému užívateľovy pribudne profilové menu, tam má ponuku na prekliknutie na profil a vytvorenie nového fóra.</p>    
            <img src="images\loginuser.png" alt="" class="imgopis"  > 
            <p>Profil užívateľa zobrazuje dátum vytvorenia jeho účtu a poslané komentáre. Na komentáre je možné sa prekliknúť a dostať sa na fórum kde užívateľ komentoval.</p>
            <img src="images\profilzvyraznenie.png" alt="" class="imgopis"  > 
            <p>Formulár pre vytvorenie nového fóra, po vytvorení ho naň aj presmeruje.</p>
            <img src="images\Pridávanieblogov.png" alt="" class="imgopis"  > 
            <p>Fórum a profil majú vstupné parametre skrz get request, pri zlom zadaní vypýše na obrazovk error 404.</p>
            <img src="images\pagenotfound.png" alt="" class="imgopis"  > 

        </div>
        </div>




        <div style="padding:80px"><br></div>


</body>
</html>