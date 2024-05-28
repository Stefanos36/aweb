

<?php
function headerdb( ){


   

echo" <div class=\"header\">
    <div class=\"header-left-center\"> 
    <i class=\"bi bi-book-half logo\"></i>
    <div class=\"textS\" >";
echo nazovServera()." <br>"; 

    if(checkSession()){
        echo "Prihlaseny: ". getSessionUser();
    }
    else{
        echo "Neprihlaseny";
    }
echo "

</div>
";
?>
<div class="mobilehide">
<!-- <button class=" bi bi-list navbarbutton" onclick="nastavmenubar()"></button> -->

 </div>


</div>

    <div class="mobilehide" style="margin-left: auto">
        <div   >
        <button class=" bi bi-list navbarbutton" onclick="nastavmenubar()"></button>
        </div>
    </div>
    
<div class="webhide">
    <div class="displayFlex">
        <div class="">
            <a  class="padding width" href="index.php">Home</a></div>
    <div><a  class="padding width " href="#">info</a></div>
    


<script src="navbar.js"></script>
<div>
<!-- <button class="button padding" onclick="odhlasma()" >odhlas</button> -->
</div>
<?php


    if(checkSession()){
        echo "<div>";
       // echo "<a class=\"width padding\" href=\"login.php\" id=\"loginout\">Logout</a>";
       // echo "<button class=\"button padding\" onclick=\"odhlasma()\" >Logout</button>";
        echo "<a class=\"width padding\" href=\"logout.php\"  >Logout</a>";
        echo "</div>";
    }else{
        echo "<div>";
        echo "<a class=\"width padding\" href=\"login.php\"  >Login</a>";

        echo "</div>";
        echo "<div>";
        echo "<a class=\"width padding\" href=\"signup.php\" >Signup</a>";
        echo "</div>";
    }

   // <a href=\"#about\">Odhlasit</a>
echo " </div>";

?>


</div>


</div>
<div class="mobilehide">

<div class=" header2"> 

<ul id="menubar" >
    
      <li ><a class="padding " style="width: 100%;" href="index.php">Home</a></li>
      <li class="dropdown">
        <li><a class="padding " style="width: 100%;" href="#">info</a></li>

        <?php 
        
        if(checkSession()){
            echo "<a class=\"padding \" href=\"logout.php\" style=\"width: 100%;\" >Logout</a>";
    
        }else{
            echo "<a class=\"padding \" href=\"login.php\" style=\"width: 100%;\" >Login</a>";
            echo "<a class=\"padding \" href=\"signup.php\" style=\"width: 100%;\" >Signup</a>";
        }
        ?>
          
      </li>
     
    </ul>
</div>
</div>

<!-- <h2 class="odsekzhora" ></h2> "; -->
<div class="odsekzhora"><br></div>
 <script src="odhlasenie.js"></script>
<?php 
}
//<h2 class=\"odsekzhora\" ></h2> 









