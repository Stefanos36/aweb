<?php


$dbConfigs = [
    [   
        'host' => 'localhost:3307',  //ja mam na 3307 ale normalne by stacilo iba localhost
        'user' => 'pma',             
        'pass' => '',
        'name' => 'aweb_db'
    ],
    [
        //poznamka: pre vlastne pripojenie, prenastavit podla seba pre sql databazu
        'host' => 'localhost',  
        'user' => 'pma',
        'pass' => '',
        'name' => 'aweb_db'
    ],
    [
        //pripojenie k sql co mam online
        'host' => 'localhost',
        'user' => 'id22129471_steeve',
        'pass' => 'tieto!Hesla1',
        'name' => 'id22129471_sadmin'
    ]
];
//connection

//mysqli_report(MYSQLI_REPORT_OFF); //TODO mozno potom lepsie vypnut pri testovani
function dbConnect(){
    //cyklus kym sa nepodari pr
    foreach ($GLOBALS['dbConfigs'] as $config) {
        try{

            $mysqli = new mysqli($config ['host'], $config ['user'],  $config ['pass'], $config ['name']);
            if ($mysqli->connect_errno) {
                throw new Exception("Connection failed: " . $mysqli->connect_error); //neviem ci vypise
            }

            return $mysqli; 

        } catch (Exception $e) {
           // echo $e->getMessage() . "<br>";
            $mysqli = null;
        }
      

    }

    if ($mysqli === null) { 
        die("All connection attempts failed.");
    }
    

   

}


function nazovServera(){ 

    
    foreach ($GLOBALS['dbConfigs'] as $config) {

        try{

            $mysqli = new mysqli($config ['host'], $config ['user'],  $config ['pass'], $config ['name']);
            if ($mysqli->connect_errno) {
                throw new Exception("Connection failed: " . $mysqli->connect_error); //neviem ci vypise
            }



            return  $config ['name'] ; //pri prvom najdeni to ukonci
        } catch (Exception $e) {

           // echo $e->getMessage() . "<br>";
            $mysqli = null;
        }
      

    }

    if ($mysqli === null) { 
        die("All connection attempts to database failed.");
    }
    

    
    
}
