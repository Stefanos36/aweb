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
    <title>Honeypotlog</title>
    <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-icons.css">
        <script src="odhlasenie.js"></script>
</head>
<body>
    
<div class="blogpost" >
        <div class="blogobsah" >
            <h2>Honeypot log</h2>
</div>
            <div class ="comments">
                    <br>
            <?php 
              // print_r( honeypotlog()[0]);
    
               foreach(honeypotlog() as $log){
                
                ?>
                <div class="comment">
                <?php
                  //  echo"<br>";
                //print_r($log);
                print_r($log['datetime']);
                echo " ip adress:";
                print_r($log['ip_adress']);
                echo "<br>";
                print_r($log['activity']);
                ?>
                </div>
                    <?php
               }

            ?>
           
        </div>
    </div>

</body>
</html>