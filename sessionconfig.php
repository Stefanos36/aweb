<?php


//ini_set('session.use_only_cookies', 1); //
//ini_set('session.use_only_strict_mode', 1); //TODO SPOSOBUJE problemy


//ten localhost bude daco ine v life serverim,  hmmmm :(

    //moja domena namiesto localhost: webtestproject123.000webhostapp.com
    //ci tam nemam pridat localhost:3307
session_set_cookie_params([
    'lifetime'=>1800,
    'domain'=>'localhost' ,
    'path' =>'/',
    'secure' => true,
    'httponly' => true

]); //zivotnost cookie

session_start();

//session_regenerate_id(true); //znova vygeneruje session id

//Problem so session?
//&& !empty($_SESSION['last_regeneration'])
//asi zbytocne ?
if (isset($_SESSION['last_regeneration']  )  ||empty($_SESSION['last_regeneration']) ){
    session_regenerate_id(true);
    $_SESSION['last_regeneration'] = time();


}else{
    $interval = 60*30;
   // echo $_SESSION['last_regeneration'];
    print_r($_SESSION['last_regeneration']);

    if(time() - $_SESSION['last_regeneration'] >= $interval){
        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();

    }

} //kazdych 30 min to vygeneruje session



function checkSession(){
    //zistime ci username a password nieco obsahuju a ak ano tak to overime ci good input
    if (isset($_SESSION['username']) && !empty($_SESSION['username']) 
        && isset($_SESSION['password']) && !empty($_SESSION['password']) ) {
        // Používateľ je prihlásený
        //echo "Používateľ je prihlásený ako: " . $_SESSION['username'];

        // $_SESSION["username"]= $username; 
        //             $_SESSION["password"]= $password; 


        //overime este aj platnost
        if( checkUsernamelogin($_SESSION["username"], $_SESSION["password"])){
          //  echo "session funguje";
            return true;
        }
        else{
          //  echo "ma udaje ale nefunguje session";
            return false;
        }
        
    } else {
        // Používateľ nie je prihlásený
       // echo "Používateľ nie je prihlásený.";
        return false;
    }

    

}

function getSessionUser(){

    return $_SESSION["username"];
}

function echoTime(){

    echo $_SESSION['last_regeneration'];
}

//funkcia co overi ci je prihlaseny a ked ne tak ho presmeruje? good I quess?