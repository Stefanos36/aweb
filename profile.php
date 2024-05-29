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

    //budem musiet pridat
   if(isset($_GET['profilename'])){ //ci dostaneme $_get z tochto?
        $profilename = $_GET['profilename'];
        
        $profilename =    filter_input(INPUT_GET, "profilename", FILTER_SANITIZE_SPECIAL_CHARS);
     
        echo"<title>Profile:".  prefiltruj( $profilename)."</title>";

    }


//budem musiet zamietnut pristup ked nebude prihlaseny
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-icons.css">
    <script src="odhlasenie.js"></script>
</head>
<body>
    <?php //echo getSessionUser();
          if( empty($profilename)|| count (getUserbyName($profilename))===0 ){ //ci dostaneme $_get z tochto?
            //treba poriesit aby to dalej neslo
           
            
            //ak nenajde posli ho do prec
            //alebo vytvorit stranku kde je napisane ze nenaslo?

            $profilename = false;
          
            ?>
             <div class="marginbasic" style="margin-top:20%">
            <div class="changea">
                        <div class="profile" style="display:grid">
                            <div style=" background-color:rgb(23, 30, 39); padding:15px ;border-radius:4px; font-size:larger">
                                <h2 style="text-align:center">
                                <?php 
                                //echo  getSessionUser();
                                echo"Page not found 404";
                                ?></h2>
                            </div>
                            
                            
                            
                        </div>  
                    </div>
                </div>
            <?php

            //header("Location: index.php");
            die;
        }
    
    
    
    ?>
    <!-- daco podobne ako comentarova sekcia ale len pre dany profil -->

    <div class="blogpost">
        <div class="blogobsah">
            <!-- <h2>David </h2> -->
            <h2> <?php echo $profilename; ?> </h2>
            

            <p>account created: 

            <?php 
             
              print_r(  getUserbyName($profilename)[0]['reg_date']);
            ?>
            </p>
            <!-- <label for="">account created: xyz</label> -->

    
        </div>
        <!--  nacitat jeho komentare -->
        <!-- najprv vzor html, vzor vyzera pouzitelne -->

        <div class="comments">
            <h3>Posted Comments</h3>
            <!-- vzor -->
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

           $data= getprofilecomments(getUserbyName($profilename)[0]['id']);
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
    <div style="padding:80px"><br></div>
</body>
</html>