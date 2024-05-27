<?php

//require "connection.php";

//to mu dodam , funkciou cez connection

//teoreticky mozem nahadzat vsade - bo vstup uz automaticky filtrujem tymto
//filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS)
//htmlspecialchars($vstup, ENT_QUOTES, 'UTF-8')
//obe pouzivaju utf-8 standart - sourse chatgpt
function prefiltruj($vstup){
   $vstup=  htmlspecialchars($vstup, ENT_QUOTES, 'UTF-8');
   //znaky co boli uz raz prefiltrovane budu znova
    $vstup= str_replace(['&amp;', '&lt;', '&gt;', '&quot;', '&#039;'], ['&', '<', '>', '"', "'"], $vstup);
    
  return $vstup ;
}


function check_login($con){

        if(isset($_SESSION['user_id'])) //pozerame ci hodnota existuje
        {

        $id = $_SESSION['user_id'];
        $query = "select * from users where user_id = '$id' limit 1"; //sql kod
        $result = mysqli_query($con,$query);
        
        if($result && mysqli_num_rows($result) > 0)  //ci je
        {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }

   }

   //redirectovanie na login
   header("Location: login.php");
   die;

   //test z dynamickeho vytvarania

}






//funkcia na dostanie vsetkych blogpostov?
function getBlogposts(){
    $mysql= dbConnect();
    if($mysql==false){ //?? test
         
        die("");
    }
    //zevraj toto ochranuje aj voci injection, idk
    $result = $mysql->query("SELECT * FROM blogposts"); 
    
    $data=$result->fetch_all(MYSQLI_ASSOC);

    return $data;
}

//na vstupe ocakavam z akeho to je blogu
function getComments($id_blog){
    $mysql= dbConnect();

    //zevraj toto ochranuje aj voci injection, idk
    $result = $mysql->query("SELECT * FROM comments WHERE id_blog= $id_blog ORDER BY comment_date"); 
    
    $data=$result->fetch_all(MYSQLI_ASSOC);

    return $data;


}


//funkcia na vytiahnutie komentarov?
//komentare co sa vytiahnu treba sanitizovat ci ?

//do  poslem meno co chcem vytiahnut
function getBlogpostByblogpostname($blogpostname){
    $mysql= dbConnect();

    //zevraj toto ochranuje aj voci injection, idk
    $sql = $mysql->prepare("SELECT * FROM blogposts WHERE blog_name = ? "); 
    $sql->bind_param("s",$blogpostname);    
    $sql->execute();
    $result= $sql->get_result();
    $data=$result->fetch_all(MYSQLI_ASSOC);
    return $data;
}

//iba ci existuje
function checkUsername( $username ){
    $mysql= dbConnect();
    $sql = $mysql->prepare("SELECT * FROM users WHERE username= ?");
    $sql->bind_param("s",$username);
    $sql->execute();
    $result= $sql->get_result();
    $data=$result->fetch_all(MYSQLI_ASSOC);
    if( empty($data)){
        
        return false;
    }else{
        return true;

    }

}


//ak by sa aj podarilo dat neplatny username
function checkUsernamelogin($username, $password){


    $mysql= dbConnect();
    $sql = $mysql->prepare("SELECT * FROM users WHERE username= ?");
    $sql->bind_param("s",$username);
    $sql->execute();
    $result= $sql->get_result();
    $data=$result->fetch_all(MYSQLI_ASSOC);
   
    if( empty($data)){
        
        return false;
    }else{
        
        $salt = zoberSol($username);
        //TODO upravit aby bralo aj sol
        if( password_verify($password.$salt ,$data[0]["password"]) ){
        

            return true;
        }

    }


    return false;
    

    
}

function addUser($username, $password){
    $mysql= dbConnect();
    //mozem aj tuna pre istotu overit ci nerobim duplikat
    if(checkUsername($username)){
        return;
    }

    //TODO nerozbijem to zakomentovanim prveho?????
    //$sql = $mysql->prepare("SELECT * FROM users WHERE username= ?");
    $salt = generateRandomString();
    echo "<br>password <br>".$password;
    echo "<br>salt  <br>".$salt;

    echo "<br>  ".$password.$salt; //nemozem plusnut

    $hash = password_hash( $password.$salt, PASSWORD_DEFAULT );

    echo "<br>hash:  <br>".strlen($hash) ;
    echo "<br>hash:  <br>".$hash ;
    

    //pri logine budem musiet natiahnut este sol
    $odhashuj = password_verify($password.$salt ,$hash); 
    echo "<br> ".strlen($odhashuj) ;
    echo "<br>".$odhashuj ;

    $sql = $mysql->prepare("INSERT INTO users (username, password,salt ,reg_date)
    VALUES (?, ?,?,NOW())"); //now mi prida sucasny cas
    $sql->bind_param("sss",$username,$hash, $salt);
    
    //print_r($sql);
   
    
    if($sql->execute()){
        echo"<br>vykonalo";
    }else{
        echo "<br>nevykonalo";
    }
    
    //potrebujem hashnut heslo

}

function getUserbyId($userid){

    $mysql= dbConnect();
    $sql = $mysql->prepare("SELECT * FROM users WHERE id = ?");
    $sql->bind_param("s",$userid);
    $sql->execute();
    $result= $sql->get_result();

   // print_r( $result );
    $data=$result->fetch_all(MYSQLI_ASSOC);
    //print_r( $data );
    return $data;
    /*
    $data=$result->fetch_all(MYSQLI_ASSOC);
    if( empty($data)){
        
        return false;
    }else{
        return true;

    }*/
}

function getUserbyName($username){

    $mysql= dbConnect();
    $sql = $mysql->prepare("SELECT * FROM users WHERE username = ?");
    $sql->bind_param("s",$username);
    $sql->execute();
    $result= $sql->get_result();

   // print_r( $result );
    $data=$result->fetch_all(MYSQLI_ASSOC);
    //print_r( $data );
    return $data;
    /*
    $data=$result->fetch_all(MYSQLI_ASSOC);
    if( empty($data)){
        
        return false;
    }else{
        return true;

    }*/
}



function addcommentLog($comment, $username, $id_blog  ){
    $mysql= dbConnect();
    //najdi cloveka v sql databaze, zisti jeho id
    //ci je dobry vstup
    if(checkUsername($username)){
        print_r(getUserbyName($username));
        echo"<br>";
        echo "get ". getUserbyName($username)[0]["id"];
        $usernameID = getUserbyName($username)[0]["id"];
        echo "iduzivatela ".$usernameID;
        //cislo pre blogpost

        // $sql = $mysql->prepare("INSERT INTO blogposts (id_user, id_blog, comment, comment_date )
        // VALUES (?, ? ,? , NOW()");
        // $sql->bind_param("sss",$usernameID, $id_blog, $comment);
        echo "<br>usernameId: ".$username." ".$id_blog." ".$comment;

        //TODO najst chyb
        $sql = $mysql->prepare("INSERT INTO comments (id_user, id_blog, comment) VALUES (?, ? ,? )");
        $sql->bind_param("sss",$usernameID, $id_blog, $comment);

        //zistit ako addnut s foreign key
        $sql->execute();

    }else{
        echo"<br>addcommentLog";
        echo"<br>vstup je null";
        echo"<br>idblog ".$id_blog;
        echo"<br>comment ".$comment;

        $sql = $mysql->prepare("INSERT INTO comments ( id_blog, comment) VALUES ( ? ,? )");
        $sql->bind_param("ss", $id_blog, $comment);
        $sql->execute();
    }


}


//iba echo
function countComment($id_blog){

    // echo"poslane". $id_blog;
    $mysql= dbConnect();
    // $sql = $mysql->prepare("SELECT COUNT(id_blog) FROM comments WHERE id_blog = ?");
    $sql = $mysql->prepare("SELECT COUNT(*) AS pocet_vyskytov FROM comments WHERE id_blog = ?");
    $sql->bind_param("s", $id_blog);
    $sql->execute();
    $pocet =$sql->get_result()->fetch_all(MYSQLI_ASSOC);
    
    // echo"Vysledok je ";
    // //print_r($sql);
    // echo "<br>";
    // print_r($pocet);
    // echo "<br>";
    // print_r($pocet[0]);
    // echo "<br>";
    // print_r($pocet[0]["pocet_vyskytov"]);
    return $pocet[0]["pocet_vyskytov"];

}

function newpostoverenie(){
   if(!checkSession()){
    
    header("Location: index.php");
   } 
}



function generateRandomString() {
    $Length = 16;
   // $minLength = 16;
   // $maxLength = 25;
    // Povolíme všetky alfanumerické znaky a špeciálne znaky
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()-_=+[]{}|;:",.<>?/`~';
    $charactersLength = strlen($characters);
   // $randomLength = rand($minLength, $maxLength);
    $randomString = '';

    for ($i = 0; $i < $Length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

    return $randomString;
}

// Príklad použitia

function addBlog($blogname,$blogtext){
    //overit najprv session ci ide
  if( checkSession()){
    //session ide
    echo"<br>". $_SESSION["username"];
    //sql vlozit
    $mysql= dbConnect();
    //prepare
    $sql = $mysql->prepare("INSERT INTO blogposts ( blog_name, blog_text,id_user) VALUES (?, ?, ?)");

    $sql->bind_param("sss", $blogname, $blogtext, getSessionUser());
    $sql->execute();
    

  }


} 

function zoberSol($username){
    $mysql= dbConnect();
    
    $sql = $mysql->prepare("SELECT salt FROM users WHERE username= ?");
    $sql->bind_param("s",$username);
    $sql->execute();
  //  echo"<br>sol" .$sql->get_result();
   // $result->fetch_all(MYSQLI_ASSOC)
    //$sql->get_result()

    $result= $sql->get_result();
    $data=$result->fetch_all(MYSQLI_ASSOC);
  //  print_r($data[0]['salt']);
    return $data[0]['salt']; //vrati to asi prazdne ked nebola pridana este sol?

}


function overgetBlog($getblogpost){
    //over ci sa nachadza v databaze 
    $mysql= dbConnect();
    if( isset($getblogpost)){
        $sql = $mysql->prepare("SELECT * FROM blogposts WHERE blog_name = ? "); 
        $sql->bind_param("s",$getblogpost);    
        $sql->execute();
        $result= $sql->get_result();
        $data=$result->fetch_all(MYSQLI_ASSOC);
        //print_r($data);
        return $data;
    }

    return false;
}