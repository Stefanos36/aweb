<!-- znova stiahe cely subor ci daco ctrl+f5 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php 

    if(isset($_GET['blogpostname'])){ //ci dostaneme $_get z tochto?
        $blogpostname = $_GET['blogpostname'];
        
        $blogpostname =    filter_input(INPUT_GET, "blogpostname", FILTER_SANITIZE_SPECIAL_CHARS);
     
        echo"<title>Blog:". $blogpostname."</title>";

    }
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
           // echo"nenaslo blogpost";
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

                <h2> <?php echo getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['blog_name'] ;  ?> </h2>
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

            <p> <?php echo getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['blog_text'] ;?></p>
           </div>
             <div class="comments">
                <h3>Komentáre <i class="bi bi-chat-dots"></i>

                <?php 
                echo countComment( getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'] )." </h3>";
                    for($i= 0;$i<count( getComments(getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog']));$i++){
                        echo" <div class=\"comment\" >";
                        
                        echo "<strong>";
                        $comment = getComments(getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'])[$i];
                        if(empty($comment['id_user'])){
                            echo"Anon";
                        }else{
                            $userID = $comment['id_user'];
                            echo"<div class=\"bi bi-book-half\" > ";
                            //echo getComments(getBlogpostByblogpostname($GLOBALS ['blogpostname'])[0]['id_blog'])[$i]['id_user'];
                           // echo $userID."  ";
                            print_r(getUserbyId($userID)[0]["username"]);
                            echo "</div>";
                        }
                        echo "</strong>";
                       // sizeof($comment['comment'])
                        // echo strlen($comment['comment']).": ".$comment['comment'];
                      //  echo ""<script>alert('XSS útok!');</script>"";
                        
                      //TODO testujem
                       // $test = "<script>alert('XSS útok!');</script>";
                        //echo  "".$test."";
                       // print_r($comment['id_comment']);
                        echo "<div class=\"word-break\" id=c".$comment['id_comment']." >";

                        echo $comment['comment'];
                        
                        //print_r($comment['comment']) ;
                        echo "</div>";
                       
                    
                        echo "<div class=\"subforum-info subforum-column\">";
                        echo "<small> <i class=\"bi bi-clock\"></i>
                        ";
                        echo  date( "H:i d.m.Y",strtotime( $comment['comment_date']  )) ;
                        echo "</small>";

                        echo" </div>";
                        echo" </div>";

                    }

                
                ?>

                
            </div>
                    <!-- prisposobyt tomu ci je prihlaseny? -->
            
            <form action="#" method="POST" id="commentForm" class="text">
                    <?php 
                        //overit prihlasenie 
                        if(checkSession()){
                            //prihlaseny
                            
                            

                        }else{

                            echo " neprihlaseny";
                            echo " <a class=\"underline-hover\" href=\"http://localhost/aweb/login.php\">mas ucet? Prihlasit sa</a><br>  ";
                        }
                        
                    ?>
                
                
                <label for="comment">Komentár:</label><br>
                <!-- rows="4" cols="50" -->
                <!--  -->
                <textarea id="comment" name="comment"  rows="3"  class="textarea "  style="width:100%" required maxlength="200"></textarea><br>
                <input class="button" type="submit" value="Odoslať">
            </form>

            <?php 
            //zobrat vstup z formulara
                if($_SERVER['REQUEST_METHOD'] == "POST") 
                {  
                    
                    $comment = filter_input(INPUT_POST,"comment",FILTER_SANITIZE_SPECIAL_CHARS);
                    echo $comment."<br>";

                    if(empty($comment) || strlen($comment)  > 200){
                        echo "TODO odkomentovat neplatne". strlen($comment)  ;
                    }else{



                        if(checkSession()){

                            echo $_SESSION["username"]." <br>";
                            $blogpostname = urldecode($_GET['blogpostname']);
                            echo '<br>'.$blogpostname.'<br>';


                            $idblog=  getBlogpostByblogpostname($blogpostname)[0]["id_blog"];
                            echo "<br>".$idblog. "<br>";
                            addcommentLog($comment, $_SESSION["username"] , $idblog );
                            
                            echo "<br> url ".urldecode($_GET['blogpostname']);
                            echo "<br> url ".urlencode($_GET['blogpostname']);

                            //TODO docasne zakomentovane
                            header("Location: blog.php?blogpostname=" . $_GET['blogpostname']); // v takomto stve treba to dat 
                        //  header("Location: ".$_SERVER['PHP_SELF']);
                            exit(); 
                        }else{
                            
                            echo '<br>neprihlásený';
                            $blogpostname = urldecode($_GET['blogpostname']);
                            echo '<br>blogname: '.$blogpostname;
                            $idblog=  getBlogpostByblogpostname($blogpostname)[0]["id_blog"];
                            echo "<br>idblog: ".$idblog. "<br>";

                            addcommentLog($comment,null , $idblog );
                            header("Location: blog.php?blogpostname=" . $_GET['blogpostname']); 
                            //header("Location: ".$_SERVER['PHP_SELF']);
                            
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




