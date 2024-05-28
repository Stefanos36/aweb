<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Registracia</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-icons.css">
        <link rel="stylesheet" href="logincss.css">
        <script src="script.js"></script>

 </head>
 <body>
 <?php
     require ("connection.php");
     include "header.php" ;
     require_once ("sessionconfig.php");
     require_once ("honeypot.php");
     include("functions.php");
    headerdb();
 ?>


    <div id="box">

    <form method="post">  <!--//preposle post metodu--> 
        <!-- <div style="font-size: 20px; margin: 10px; color: white;">Signup/Registracia</div> -->
        <h2>Signup/Registracia</h2>
        <label id="username" class="text">Username</label>
        <!-- <input class="text" type="text" name="username" maxlength="25" >    -->
       
        <!-- vytvorit neskor decoy ,Honeypot checkform  upravit pre testovanie, vlozit do samostatneho php subora ako funkciu
            co bude generovat dynamicky podla stranky? - ok  
         -->
        <!-- <div class="checkform" >
            <label class="text">First name</label>
            <input class="text" type="text" name="firstname"  >
            <label class="text">Last name</label>
            <input class="text" type="text" name="lastname"  >
            <br>
        </div> -->
       <?php
   

        $array = array("First_name","Last_name");
      //  print_r($params);
//  navnada("First name", "Last name");
      //  navnada($params);
        navnada($array);
    //    chytajnavnadu($params);
       ?>

        <label class="text" id="password">Password</label><br>
        <!-- <input class="text"  type="password" name="password" maxlength="40"  > <br> -->

        <label class="text" id="password2">Repeat Password</label><br>
        <!-- <input class="text" type="password" name="password2"  > <br><br> -->
        <input  class="button" id="button" type="submit" value="Signup"> <br><br>   <!--//submit spusti ten script?--> 

        <a class="underline-hover" href="login.php">Click to Login/Stlac pre prihlasenie</a>
    </form>
    </div>
        <script>
           
             registraionformular();

        </script>

<?php 

    if($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        
        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
        $password2= filter_input(INPUT_POST,"password2",FILTER_SANITIZE_SPECIAL_CHARS);

    
   


        //nepusti dalej ak je viacej
        if(empty($username) || strlen($username) > 25 ){
          
            echo "<div class=\"warning\">Enter username, max 25 characters</div>" ;
           

        }elseif(empty($password) || strlen($password) > 40){
            echo "<div class=\"warning\">Enter password, max 40 characters</div>" ;
            

        }elseif(empty($password2) || !($password == $password2)){
            echo "<div class=\"warning\"> Repeat password to confirm</div>" ;

        }else{
            //vyplnil vsetko spravne, potrebujem overit ci v sql existuje zaznam

            if(checkUsername($username) ){

                echo "<div class=\"warning\">Username je obsadeny, zvolte iny</div>" ;
            }else{
                echo "Username nie je obsadeny - good <br>";


                //upravit a zasolit este heslo https://en.wikipedia.org/wiki/Salt_(cryptography)

                //mozem ho pridat
               // $hash = password_hash( $password, PASSWORD_DEFAULT );
               
                addUser($username, $password);
               // header("Location: login.php");

            }
        }



    }

?>



 </body>
 </html>