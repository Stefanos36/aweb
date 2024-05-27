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
        <input class="text" type="text" name="username" maxlength="25" >  <br> 
       
        <!-- vytvorit neskor decoy-->
        <div class="confirm" id="myForm">
            <label class="text">Real name</label>
            <input class="text" type="text" name="name"  >
            <br>
        </div>
        <script>
             window.onload = function() {
            var honeypot = document.createElement('input');
            honeypot.type = 'text';
            honeypot.name = 'forename';
            honeypot.className= 'text';
            // honeypot.style.display = 'none';
            document.getElementById('myForm').appendChild(honeypot);
            }

        </script>

        <label class="text">Password</label><br>
        <input class="text"  type="password" name="password" maxlength="40"  > <br>
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

        //honeypot
        $name= filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
        $forename = filter_input(INPUT_POST,"forename",FILTER_SANITIZE_SPECIAL_CHARS);
        //staci vytvorit zaznam?

        echo"name ".$name."<br>forename ".$forename;
       





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