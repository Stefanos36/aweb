  <?php   
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
        <title>Forum</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="bootstrap-icons.css">
        <script src="odhlasenie.js"></script>
    </head>
    <body>

    <style>
       

    </style>

    <!-- pridat kolonku pre prihlasenych pre vytvorenie fora -->
    <div class="marginbasic">

    <?php 
    //checkSession()
    if(checkSession()){
    
        ?>
        <div class="changea">
            <div class="profile" style="display:flex">
                <div style=" background-color:rgb(23, 30, 39); padding:15px ;border-radius:4px; font-size:larger">
                    <?php 
                    echo  prefiltruj (getSessionUser());
                   
                    ?>
                </div>
                
                <div style="margin-left:auto; align-content:center">
                    <a class="button" href="profile.php">Profile</a>
                    <a class="button" href="newpost.php">new Post</a>
                </div>
                
            </div>  
        </div>
        
        <?php

        }
    
    ?>
      
    </div>

    <?php   
    
       for($i= 0; $i< count(getBlogposts()); $i++){
       // echo"".getBlogposts()[$i]["blog_name"] ."<br>";
       
        //treba tam dat aj url encode do toho
       // echo "<a href=\"blog.php?blogpostname=".urlencode( getBlogposts()[$i]["blog_name"])."\">".getBlogposts()[$i]["blog_name"]  ."</a><br>"; //posle nam do url data
        
    //    echo"<div class=\"blog\">";
    echo"<div class=\"marginbasic\">";
       echo "<a class=\"changea\" href=\"blog.php?blogpostname=".urlencode( getBlogposts()[$i]["blog_name"])."\" >";
       ?>
        <div class="blog">
        <div class="blogobsah">
        <div style="display:flex; ">
<div>
        <h2>

       <?php

    //echo"<div class=\"blog\">";
    // echo "<div class=\"blogobsah\">"; 

        // echo  "<div style>";
        // echo "<h2>";
        echo"".prefiltruj( getBlogposts()[$i]["blog_name"]) ;
        
        echo "</h2>"; 
        echo  "</div>";
        echo  "<div class=\"casBlogu\" style= \"margin-left: auto;
        align-content: center\" >";
        echo  "<div>";
        

        echo countComment(getBlogposts()[$i]["id_blog"])." ";
       echo  "<i class=\"bi bi-chat-dots\"></i> "; 
        // <i class=\"bi bi-clock\"></i>
// "<i class=\"bi bi-clock\"></i>"
        echo date( "H:i d.m. Y",strtotime(  getBlogposts()[$i]["blog_date"] )) ;
        echo  "</div>";
        echo  "</div>";
        echo  "</div>";
        echo"".prefiltruj( getBlogposts()[$i]["blog_text"]) ."<br>";
        echo "</div>";
        echo"</div>";
        echo "</a>"; //posle nam do url data
        echo"</div>";
        // echo"</div>";
    }

?>


<div style="padding:80px"><br></div>


    </body>
</html> 


