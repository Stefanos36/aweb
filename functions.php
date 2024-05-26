<?php

//require "connection.php";

//to mu dodam , funkciou cez connection
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
        /*
        echo"<br>";
            print_r($data);
            echo"<br>";
            print_r($data[0]);
            echo"<br>";
            print_r($data[0]["reg_date"]);
            echo"<br>";
            echo "cas prveho prihlasenia ".$data[0]["reg_date"];*/
        //porovnat heslo
       /* echo"<br>";
        echo "heslo ".$data[0]["password"];
        $hash= password_hash($password,PASSWORD_DEFAULT);
        echo"<br>";
        echo"hashnute heslo ".$hash;
            
        password_verify($password,$data[0]["password"] );
        echo"<br>";*/
        

        if( password_verify($password,$data[0]["password"]) ){
        
            
           
           
           // $hash2= password_hash($data[0]["password"],PASSWORD_DEFAULT);
           // 
            //echo"hashnute heslo2 ".$hash;
            
            
            /*echo"<br>";
            echo"porovnalo hashnute hesla";*/

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
    $sql = $mysql->prepare("INSERT INTO users (username, password, reg_date)
    VALUES (?, ?,NOW())"); //now mi prida sucasny cas
    $sql->bind_param("ss",$username,$password);
    
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

