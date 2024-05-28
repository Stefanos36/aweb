<?php


function prihlasenie(){

    ?>
    <div class="checkform" >
            <label class="text">First name</label>
            <input class="text" type="text" name="firstname"  >
            <label class="text">Last name</label>
            <input class="text" type="text" name="lastname"  >
            <br>
        </div>

        
    <?php
   
}

//First name. Last name
//spravit dynamicke

//Funkcia dynamicky vytvori policka a tie potom vie odchytavat a posielat do sql
//vzor vstupu  $array = array("Hodnota1","Hodnota2","Hodnota3"); - musi byt string pokope inak nejde
function navnada($vstup){
    $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular:";
    foreach($vstup as $udaj){

      //  echo    $udaj;
            ?>
        <div class="checkform" >
            <label class="text"><?php echo $udaj; ?></label>
            <input class="text" type="text" name="<?php echo $udaj; ?>"  >
            
            <br>
        </div>
        
        <?php
            
         
    } 

    $preposlat =false;
        if($_SERVER['REQUEST_METHOD'] == "POST") 
            {    $preposlat =false;

                foreach($vstup as $udaj){

                    //echo"request ". $udaj;
                    $filtrovane= filter_input(INPUT_POST, $udaj ,FILTER_SANITIZE_SPECIAL_CHARS);
                     // $forename = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_SPECIAL_CHARS);
            
                    if (!empty($filtrovane)) {
                    
                    //  $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular: name:\" ".$name."\", forename:\" ".$forename."\"";
                        $spravaAktivit = $spravaAktivit.", ".$udaj.": \"".$filtrovane."\"";
                        // echo"<br>".$spravaAktivit."";
                        $preposlat = true;
            
                        
                    // exit();
                    }else{
                       // echo"prazdne?";
                    }
                }
                echo"<br>Vysledne".$spravaAktivit;
            } 


    
        if($preposlat){


        }    
        honeypot($spravaAktivit);

    /*
    ?>



    <div class="checkform" id="myForm">
            <label class="text"><?php echo $vstup1; ?></label>
            <input class="text" type="text" name="firstname"  >
            
            <label class="text"><?php echo $vstup2; ?></label>
            <input class="text" type="text" name="lastname"  >
            <br>
        </div>

        
    <?php

    if($_SERVER['REQUEST_METHOD'] == "POST") 
    {
        $name= filter_input(INPUT_POST,"firstname",FILTER_SANITIZE_SPECIAL_CHARS);
        $forename = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_SPECIAL_CHARS);

        if (!empty($name) || !empty($forename)) {
            // $bot_ip = get_client_ip();
            // $timestamp = date("Y-m-d H:i:s");
            // file_put_contents('bot_log.txt', "Bot detected from IP: $bot_ip at $timestamp\n", FILE_APPEND);
        
            // // Pridanie IP adresy do blokovaného zoznamu
            // file_put_contents('blocked_ips.txt', "$bot_ip\n", FILE_APPEND);

            //echo "ides???????????????????";

            //vytvorit zaznam v sql tabulke //pridat aj ostatne veci z aktivity - user a heslo
            $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular: name:\" ".$name."\", forename:\" ".$forename."\"";
        // echo"<br>".$spravaAktivit."";
            honeypot($spravaAktivit);

            
            exit();
        }
    */
    
}

// function chytajnavnadu($vstup){
//     $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular:";

//     if($_SERVER['REQUEST_METHOD'] == "POST") 
//     {

//         foreach($vstup as $k=>$udaj){
//             $filtrovane= filter_input(INPUT_POST, $udaj ,FILTER_SANITIZE_SPECIAL_CHARS);
//         // $forename = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_SPECIAL_CHARS);
    
//             if (!empty($filtrovane)) {
            
//             //  $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular: name:\" ".$name."\", forename:\" ".$forename."\"";
//                 $spravaAktivit = $spravaAktivit.", ".$udaj.": \"".$filtrovane;
//                 // echo"<br>".$spravaAktivit."";
            
    
                
//             // exit();
//             }else{
//                 echo"prazdne?";
//             }
//         }
//     }



// echo"<br>".$spravaAktivit;

// }

