<?php   
        require("connection.php");
        require("functions.php");
        require("sessionconfig.php");
        include("header.php");
        headerdb();
       // newpostoverenie();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>new Post</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-icons.css">
        <script src="odhlasenie.js"></script>
    </head>
    <body>
        <!-- create new post -->
        

        <div class="marginbasic">


       
            <div class="changea">
                <div class="profile" >

                    <form method="post">
                        <div style=" background-color:rgb(23, 30, 39); padding:15px ;border-radius:4px; font-size:larger ;display:flex">


                            Title:
                            <input style="margin-left: auto; font-weight:bold; " type="text">
                        </div>
                        <br>

                        <div style=" background-color:rgb(23, 30, 39); padding:15px ;border-radius:4px; font-size:larger ;">
                            
                        <div style="width:100%">
                                Content:
                        </div>

                        <!-- <input type="textarea" style="resize: none; width: 100%; font-size:larger" rows="6"> -->
                        <textarea name="" id="" style="resize: none; width: 100%; font-size:larger" rows="6"></textarea>
                        </div>
                        
                        <input class="button" type="button" value="odoslat">
                    </form>
                </div>
            </div>
        </div>  
            
        <?php 
        
        ?>

         
        
    </body>
    </html>