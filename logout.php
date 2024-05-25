<?php
//session_start();
include("sessionconfig.php");

echo"toto by si nemal vidiet";
//echo $_SESSION['username'];
session_unset();  //nefunguje ani jedno?
//session_destroy();
echo $_SESSION['username'];
getSessionUser();
header("Location: login.php");
?>
<br>

<h2>Pre testovacie uceli, preklikni sem => <a href="login.php">login</a></h2>
//header("Location: login.php");
