<?php

//spravit rychlo profil pre uzivatelov
//pridat header,
// cas vytvorenia uctu 
//commenty co vytvoril
require("connection.php");
require("functions.php");
require("sessionconfig.php");
include("header.php");
headerdb();

//budem musiet zamietnut pristup ked nebude prihlaseny
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile: David <?php echo getSessionUser(); ?> </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <script src="odhlasenie.js"></script>
</head>
<body>
    <?php //echo getSessionUser(); ?>
    <!-- daco podobne ako comentarova sekcia ale len pre dany profil -->
    <div class="blogpost">
        <div class="blogobsah">
            <h2>David</h2>
            <p>account created: xyz</p>
            <!-- <label for="">account created: xyz</label> -->

    
        </div>
        <!--  nacitat jeho komentare -->
        <!-- najprv vzor html, vzor vyzera pouzitelne -->

        <div class="comments">
            <h3>Posted Comments</h3>

            <!-- <div class="comment">

                <strong>Nazov blogu</strong>
                    <div class="word-break" id="" >
                        vlastny komentar
                    </div>
                
                <small> 
                    <i class="bi bi-clock"></i> 
                    12:54 21.05.2024
                </small>
            </div>



             <div class="comment">

                <strong>Nazov blogu</strong>
                    <div class="word-break" id="" >
                        vlastny komentar
                    </div>
                
                <small> 
                    <i class="bi bi-clock"></i> 
                    12:54 21.05.2024
                </small>
            </div> -->
        <?php 

           $data= getprofilecomments();
          // $pocitadlo = 0;
           foreach($data as $comment){

                ?>

                <!-- href=\"blog.php?blogpostname=".urlencode( getBlogposts()[$i]["blog_name"])." -->
                <!-- potrebujem blogname -->
                <a href="blog.php?blogpostname=<?php echo findblogbyidreturnname($comment['id_blog']  ); ?> "  class="changea" style="color: unset;">
                 <div class="selectcomment">

                    <strong> <?php echo findblogbyidreturnname($comment['id_blog']  );  ?></strong>
                    <div class="word-break" >
                        <?php  
                        echo $comment['comment'];
                        ?>


                    </div>
                    <small>
                    <i class="bi bi-clock"></i> 
                       <?php  echo  date( "H:i d.m. Y",strtotime($comment['comment_date']));

                       ?>
                    </small>

                    </div>
                    </a>
                <?php


           }
           
           ?>
    </div>
    </div>
</body>
</html>