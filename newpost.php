<?php   
        require("connection.php");
        require("functions.php");
        require("sessionconfig.php");
        include("header.php");
        headerdb();

       
        newpostoverenie();
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

                            <!--  required -->
                            Title:
                            <input style="margin-left: auto; font-weight:bold; " type="text" name="blog_name">
                        </div>
                        <br>

                        <div style=" background-color:rgb(23, 30, 39); padding:15px ;border-radius:4px; font-size:larger ;">
                            
                        <div style="width:100%">
                                Content:
                        </div>

                        <!-- required -->
                        <textarea name="blog_text" id="" style="resize: none; width: 100%; font-size:larger" rows="6" ></textarea>
                        </div>
                        
                        <input class="button" type="submit" value="odoslat">

                        <div id="" style="color:red"> color test</div>
                    </form>
                </div>
            </div>
        </div>  
            
        <?php 
        echo  "<br>random string ".generateRandomString();
        
    

        if($_SERVER['REQUEST_METHOD'] == "POST") 
        {

            //<script>alert('XSS útok!');</script>
            //echo"<br>";
           // echo"poslal";
          //  $test = $_POST['blog_name']; ///napady, preposlat na inu stranku co si ulozi do session ci nebol pokus o script?
            //z tadial vykona kod co neumozni inam sa dostat?
            //echo"<br> ".$test;
            
            // sanitizovat vstup

            $blogname = filter_input(INPUT_POST,"blog_name",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
            $blogtext = filter_input(INPUT_POST,"blog_text",FILTER_SANITIZE_SPECIAL_CHARS); //aby nam nepreposlali script do toho
           // $password2= filter_input(INPUT_POST,"password2",FILTER_SANITIZE_SPECIAL_CHARS);
    
            // -||
            echo "<br>".$blogname;
            echo "<br>".strlen($blogname);
            if(empty($blogname) || strlen($blogname)>40  ){
                echo "<br> blogname zly vstup ". strlen($blogname);

            }elseif(empty($blogtext) || strlen($blogtext)>500){
                echo "<br> blogtext zly vstup ".strlen($blogtext) ;
            }
            else{
                //prepared sequence
                            
                            addBlog($blogname,$blogtext);
                            //poslat ho na novu stranku i quess?
                            //daco ako header("Location: blog.php?blogpostname=" . $_GET['blogpostname']); 
                        // blog.php?blogpostname=".urlencode( getBlogposts()[$i]["blog_name"])
                            
                       
                     
                        header("Location: blog.php?blogpostname=".urlencode($blogname));

            }
            

        }
        ?>

         
        
    </body>
    </html>