<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup/Registracia</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-icons.css">
        <link rel="stylesheet" href="logincss.css">

 </head>
 <body>
 <?php
     require ("connection.php");
     include "header.php" ;
     require_once ("sessionconfig.php");
     include("functions.php");
    headerdb();
 ?>


    <div id="box">

    <form method="post">  <!--//preposle post metodu--> 
        <!-- <div style="font-size: 20px; margin: 10px; color: white;">Signup/Registracia</div> -->
        <h2>Signup/Registracia</h2>
        <label class="text">Username</label><br>
        <input class="text" type="text" name="username" >  <br> <!-- vytvorit neskor decoy-->
        <label class="text">Password</label><br>
        <input class="text"  type="password" name="password" > <br>
        <label class="text">Repeat Password</label><br>
        <input class="text" type="password" name="password2" > <br><br>
        <input  class="button" id="button" type="submit" value="Signup"> <br><br>   <!--//submit spusti ten script?--> 

        <a class="underline-hover" href="login.php">Click to Login/Stlac pre prihlasenie</a>
    </form>
    </div>


<?php 

    if($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        
        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
        $password2= filter_input(INPUT_POST,"password2",FILTER_SANITIZE_SPECIAL_CHARS);

       // echo"<br>".$username."<br>".$password."<br>".$password2;
        
        

        if(empty($username) ){
          
            echo "<div class=\"warning\">Zadajte username</div>" ;
           

        }elseif(empty($password)){
            echo "<div class=\"warning\">Zadajte heslo</div>" ;
            

        }elseif(empty($password2) || !($password == $password2)){
            echo "<div class=\"warning\">znova zadajte Repeat heslo</div>" ;

        }else{
            //vyplnil vsetko spravne, potrebujem overit ci v sql existuje zaznam

            if(checkUsername($username) ){

                echo "<div class=\"warning\">Username je obsadeny, zvolte iny</div>" ;
            }else{
                echo "Username nie je obsadeny - good <br>";

                //mozem ho pridat
                $hash = password_hash( $password, PASSWORD_DEFAULT );
               
                addUser($username, $hash);
                header("Location: login.php");

            }
        }



    }

?>



 </body>
 </html>