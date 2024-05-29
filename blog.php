<!-- znova stiahe cely subor ci daco ctrl+f5 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js"></script>

<?php 

    
?>
  
   <!-- <title>Blog: </title> -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="bootstrap-icons.css">

<?php 
    //dolezite veci require
    require("connection.php");
    require("functions.php");
    require("sessionconfig.php");
    include("header.php");
    require_once ("honeypot.php");

   if(isset($_GET['blogpostname'])){ //ci dostaneme $_get z tochto?
        $blogpostname = $_GET['blogpostname'];
        
        $blogpostname =    filter_input(INPUT_GET, "blogpostname", FILTER_SANITIZE_SPECIAL_CHARS);
     
        echo"<title>Blog:".  prefiltruj( $blogpostname)."</title>";

    }
?>
 
</head>
<body>
    <?php 
    headerdb(); 


        if( empty($blogpostname) ||count( overgetBlog($blogpostname)) === 0){ //ci dostaneme $_get z tochto?
            //treba poriesit aby to dalej neslo
           
            
            //ak nenajde posli ho do prec
            //alebo vytvorit stranku kde je napisane ze nenaslo?

            $blogpostname = false;
          
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

    <div class="blogpost">
        <article>
            <!-- nacitavanie nazvu -->
            <div class="blogobsah" >
                

                <div style="display: flex"> 

                <h2> <?php echo  prefiltruj( getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['blog_name'] );  ?> </h2>
                <?php 
                echo  "<div class=\"casBlogu\" style= \"margin-left: auto;
                align-content: center\" >";
                echo  "<div>";
                // echo  "<i class=\"bi bi-chat-dots\"></i> ";
        
                // echo countComment( getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'] )." ";
                echo"  <i class=\"bi bi-clock\"></i>". date( "H:i d.m.Y",strtotime( getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['blog_date']  ))  ;
                echo  "</div>";
                echo  "</div> </div>";
                ?>

            <p> <?php echo  prefiltruj( getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['blog_text']) ;?></p>
           </div>
             <div class="comments">
             <!-- <a href=""  class="changea" style="color: unset;"> -->
                <h3>Comments <i class="bi bi-chat-dots"></i>

                <?php 
                echo countComment( getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'] )." </h3>";
                    for($i= 0;$i<count( getComments(getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog']));$i++){
                         $comment =  getComments(getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'])[$i];

                         
                        ?>
                        
                        <?php


                       // echo "<strong>";
                       
                        if(empty($comment['id_user'])){
                            ?> 
                            
                            <div class="comment" >
                            <?php
                               echo "<strong>";
                                echo"Anon";

                                echo "</strong>";
                            
                             echo "<div class=\"word-break\" id=c".$comment['id_comment']." >";
     
                             echo  prefiltruj($comment['comment']);
                             
                             
                             echo "</div>";
                            
                         
                             echo "<div class=\"subforum-info subforum-column\">";
                             echo "<small> <i class=\"bi bi-clock\"></i>";
                             echo  date( "H:i d.m.Y",  prefiltruj(strtotime( $comment['comment_date'] ) )) ;
                             echo "</small>";
     
                             echo" </div>";
                            ?> 
                            </div>
                            <?php


                        }else{
                             $userID = $comment['id_user'];
                            ?>
                             <a href="profile.php?profilename=<?php echo prefiltruj(getUserbyId($userID)[0]["username"]); ?> "   class="changea" style="color: unset;">
                            <div class="selectcomment">
                            <?php
                                echo "<strong>";
                                
                                echo"<div class=\"bi bi-book-half\" > ";
                                //echo getComments(getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'])[$i]['id_user'];
                                // echo $userID."  ";
                                // print_r(  prefiltruj(getUserbyId($userID)[0]["username"]));
                                echo  prefiltruj(getUserbyId($userID)[0]["username"]);
                                echo "</div>";



                                echo "</strong>";
                                // sizeof($comment['comment'])
                                // echo strlen($comment['comment']).": ".$comment['comment'];
                                //  echo ""<script>alert('XSS útok!');</script>"";
                                
                                //TODO testujem
                                // $test = "<script>alert('XSS útok!');</script>";
                                //echo  "".$test."";
                                // print_r($comment['id_comment']);
                                echo "<div class=\"word-break\" id=c".$comment['id_comment']." >";
        
                                echo  prefiltruj($comment['comment']);
                                
                                //print_r($comment['comment']) ;
                                echo "</div>";
                                
                            
                                echo "<div class=\"subforum-info subforum-column\">";
                                echo "<small> <i class=\"bi bi-clock\"></i>
                                ";
                                echo  date( "H:i d.m.Y",  prefiltruj(strtotime( $comment['comment_date'] ) )) ;
                                echo "</small>";
        
                                echo" </div>";


                             ?>
                             
                             
                             </div>
                            </a> 
                             <?php
                        }
                               
                    
                        

                    }
                
                ?>
  
            </div>
              
            
            <form action="#" method="POST" id="commentForm" class="text">
                    <?php 
                        //overit prihlasenie 
                        if(checkSession()){
                            //prihlaseny
                            
                            

                        }else{

                            echo " not log in";
                            echo " <a class=\"underline-hover\" href=\"http://localhost/aweb/login.php\">do you have account? log here</a><br>  ";
                        }
                        
                    ?>
                
                
                <label for="comment" id="comment">Comment:</label><br>
                <!-- rows="4" cols="50" -->
                <!-- pridak honey -->
                
                <!-- <textarea name="comment"  rows="3"  class="textarea "  style="width:100%" maxlength="200"></textarea><br> -->
                <?php 
                $array="comment2";
               // echo"count array";
                navnada($array);
                
                
                ?>

                <script> commentelement();</script>
                <input class="button" type="submit" value="Odoslať">
            </form>

            <?php 
            //zobrat vstup z formulara
                if($_SERVER['REQUEST_METHOD'] == "POST") 
                {  
                    
                    $comment = filter_input(INPUT_POST,"comment",FILTER_SANITIZE_SPECIAL_CHARS);
                  //  echo $comment."<br>";

                    if(empty($comment) || strlen($comment)  > 200){
                       // echo "TODO odkomentovat neplatne". strlen($comment)  ;

                    }else{



                        if(checkSession()){

                           // echo   $_SESSION["username"]." <br>";
                            $blogpostname = urldecode($_GET['blogpostname']);
                           // echo '<br>'.  prefiltruj($blogpostname).'<br>';


                            $idblog=  getBlogpostByblogpostname($blogpostname)[0]["id_blog"];
                          //  echo "<br>".$idblog. "<br>";
                            addcommentLog($comment, $_SESSION["username"] , $idblog );
                            
                            //echo "<br> url ".urldecode($_GET['blogpostname']);
                          //  echo "<br> url ".urlencode($_GET['blogpostname']);

                            //TODO docasne zakomentovane
                            header("Location: blog.php?blogpostname=" . $_GET['blogpostname']); // v takomto stve treba to dat 
                        
                            exit(); 
                        }else{
                            
                          //  echo '<br>neprihlásený';
                            $blogpostname = urldecode($_GET['blogpostname']);
                           // echo '<br>blogname: '.$blogpostname;
                            $idblog=  getBlogpostByblogpostname($blogpostname)[0]["id_blog"];
                          //  echo "<br>idblog: ".$idblog. "<br>";

                            addcommentLog($comment,null , $idblog );


                           // header("Location: ".getCurrentUrl() ); 
                            header("Location: blog.php?blogpostname=" . $_GET['blogpostname']); 

                            
                            
                            exit(); 
                        }
                    }

                }

                //$comment = "<script>alert('XSS útok!');</script>";
                //echo "Ošetrené: " . htmlspecialchars($comment, ENT_QUOTES, 'UTF-8') . "<br>";
               // echo "Neošetrené: " . $comment;
            ?>

        </article>
       

        
    </div>
</body>
</html>

<script src="odhlasenie.js"></script>




