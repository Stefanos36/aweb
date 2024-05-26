<?php
ob_start();  //magia co ma pomoct, ale aj tak nejde?
?>


<!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Prihlasenie</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="logincss.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

 </head>
 <body>
    <?php 
    //ob_start(); problem solver?
   // header(""); //nerozbijem to?
    require ("connection.php");
    include ("header.php") ;

    require_once ("sessionconfig.php");
    include("functions.php");

    headerdb();
    
    checkSession();
     ?>
    
 

    <div id="box">

    <form method="post">
        <!-- <div style="font-size: 20px; margin: 10px; color: white;">Login/Prihlasenie</div>
        <div style="font-size: 20px; margin: 10px; color: white;">Login/Prihlasenie</div> -->
        <h2>Login/Prihlasenie</h2>
        <!-- <label for="">Username</label><br> -->
        <label class="text">Username</label><br>

        <input  class="text" type="text" name="username" maxlength="25">  <br> <!-- vytvorit neskor decoy-->
        <label class="text">Password</label><br>
        <input  class="text" type="password" name="password" maxlength="40"> <br><br>
        <input class="button" id="button" type="submit" value="Login"> <br><br>

        <a class ="underline-hover" href="signup.php">Click to Signup/Stlac pre Registraciu</a>
    </form>
    
    </div>
    
    <!-- <div class="warning">warning   </div> -->
 </body>
 </html>

 <?php 
   


    
    if($_SERVER['REQUEST_METHOD'] == "POST") //posle metodu na server, zachytime a spracujeme
	{
		
        $username = filter_input(INPUT_POST,"username",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
        $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
       // $password = $_POST["password"];



        if(empty($username) || strlen($username) > 25){
            echo "<div class=\"warning\">Zadajte username</div>" ;
            

        }elseif(empty($password) || strlen($password) > 40){
            echo "<div class=\"warning\">Zadajte heslo</div>" ;
            

        }else{

            //funkcia na vytiahnutie soli

            

           // $hash= password_hash($password.$salt,PASSWORD_DEFAULT);
         
            if(!checkUsername($username) ){
                echo "<div class=\"warning\">Neplatny username</div>" ;
               

            }else{
                //natiahni z databazy mien a hesiel pre testovanie

                // mysqli_query(dbConnect(), $sql);
                

                /* try{
                    mysqli_query($conn,$sql);
                echo"You are now registerd!!!";
                }catch(mysqli_sql_exception $e){
                    echo "That username is taken, use another one";
                }*/
                //checkUsernamelogin($username,$password);
                if(checkUsernamelogin($username,$password)){
                    echo "<div class=\"warning\">error: ?</div>";

                    //tu chcem zadat usernmae a password do 

                    $_SESSION["username"]= $username; 
                    $_SESSION["password"]= $password; 


                    header("Location: index.php");
                    //obist to pouzitim js ?


                    exit();
                   
                }else{
                    echo "<div class=\"warning\">Neplatne heslo</div>";
                }
            }
     
        }

	}

?>

<script src="odhlasenie.js"></script>
