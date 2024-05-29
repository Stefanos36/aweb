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



//TODO nezabudnut odkomentovat v 

//First name. Last name
//spravit dynamicke

//Funkcia dynamicky vytvori policka a tie potom vie odchytavat a posielat do sql
//vzor vstupu  - musi byt string pokope inak nejde
// $array = array("Hodnota1","Hodnota2","Hodnota3");
function navnada($vstup){
    $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular:";

    if(  !is_array( $vstup )  ){
        ?>
        <div class="checkform" >
            <label class="text specialinput"><?php echo $vstup; ?></label>
            <input class="text specialinput" type="text" name="<?php echo $vstup; ?>"  >
            
            
        </div>
        
        <?php


        $preposlat =false;
                if($_SERVER['REQUEST_METHOD'] == "POST") 
                    {    //$preposlat =false;

                        $filtrovane= filter_input(INPUT_POST, $vstup ,FILTER_SANITIZE_SPECIAL_CHARS);
                     // $forename = filter_input(INPUT_POST,"lastname",FILTER_SANITIZE_SPECIAL_CHARS);
            
                    if (!empty($filtrovane)) {
                 //   echo"je prazdny? ".$filtrovane."";
                    //  $spravaAktivit = "activity in ".$_SERVER['REQUEST_URI']. " , honeypot formular: name:\" ".$name."\", forename:\" ".$forename."\"";
                        $spravaAktivit = $spravaAktivit.", ".$vstup.": \"".$filtrovane."\"";
                        // echo"<br>".$spravaAktivit."";
                      //  $preposlat = true;
            
                            honeypot($spravaAktivit);
                            die(); //aby ukoncil dalsiu aktivitu
                        
                    // exit();
                    }
                }
                
    }
    else{
        foreach($vstup as $udaj){

        //  echo    $udaj;
                ?>
            <div class="checkform" >
                <label class="text specialinput"><?php echo $udaj; ?></label>
                <input class="text specialinput" type="text" name="<?php echo $udaj; ?>"  >
                
                
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
                //  echo"<br>Vysledne".$spravaAktivit;
                 
            }

        
        if($preposlat){

            honeypot($spravaAktivit);
            die(); //aby ukoncil dalsiu aktivitu
        }    
    }


    
}



