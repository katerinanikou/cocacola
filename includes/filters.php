<?php


///////xempel FRÅN HARALD!!!!!//////////////

/*$email = $_POST['email'];

var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));
var_dump(filter_var($email, FILTER_SANITIZE_EMAIL));
var_dump(filter_var($email, FILTER_VALIDATE_EMAIL));

echo '<br><br>';

// Om någon försöker skriva in jskod så tar sanitize filteret bort taggarna = det som gör koden skadlig, men texten skrivs ändå ut.

$stringToFilter = $_POST['email'];
var_dump(filter_var($stringToFilter, FILTER_VALIDATE_EMAIL));
var_dump(filter_var($stringToFilter, FILTER_SANITIZE_EMAIL));

*/


$pagecontent = new stdClass;
$pagecontent ->title = "";

$errors = array();

if (array_key_exists('checkout', $_POST)) {

/*echo 'POST ARRAYEN:';
echo '<pre>';
var_dump($_POST);
echo '</pre>';*/



    
/************** FUNKTIONER ****************/
    if (!function_exists('notEmpty')) {
        function notEmpty($value) {
        $value = trim($value);

    if (!isset($value) || $value === "") {
    global $errors;
    
    $errors[] = ($value).'Fältet får inte vara tomt!';
 
        }
    
    }
}

    if (!function_exists('validChars')) {
        function validChars($value) {
  //Kollar att det endast är bokstäver stora/små, binderstreck eller mellanslag Nån typ av regex
    }
}

    if (!function_exists('maxChars')) {
        function maxChars($value) {
//KOLLAR ATT DET MAX ÄR 50 TECKEN I STRÄNGEN
    }
} 

if(!function_exists('validAdress') ) {
    function validAdress($value) {
        //KAN INNEHÅLLA BOKSTÄVER, SIFFROR SAMT MELLANSLAG : OCH /
    }
}

if(!function_exists('validZip') ) {
    function validZip($value) {
        //KAN INNEHÅLLA MAX 5 SIFFROR
 //   echo "validZip körs ";

     global $errors;
    

    $regexp ="/^[0-9]{5}$/";     
    $zip = $value; 
    
    $zip = preg_replace('/\s+/', '', $zip);     
 //   echo "HÄJ".$zip; 
        
        if (preg_match($regexp, $zip)) {
        isNumbers($zip);
//        echo "zip is valid";
    
    } else {

            $errors[] = 'Något är vajsing med zippen';
    }
    }
}

if(!function_exists('isPassword') ) {
    function isPassword($value) {
        //MINST 6 BOKSTÄVER PLUS EN SIFFRA
    }
}



if (!function_exists('isNumbers')) {        
function isNumbers($value) {
 global $errors;
    echo "isnumbers körs ";
  $field = $value;
  if(!is_numeric($field)) {
 $errors[] = 'AJABAJA! Fältet får endast innehålla siffror!'." ".$field;


        }
    }
}

if(!function_exists('isPhone') ) {
    function isPhone($value) {

    global $errors;
      
    $phone = $value;

    $number = 111111111111111;


        if(strlen($phone < $number) ) {
        
        echo "phone is valid";

    } else {

            $errors[] = 'Något är lurt med telefonnumret'." ".$phone;
    }
            
}

} 




    /* $phone is valid

$phone = '031-313131';

 $regexp = '/^[0-9]+(\s|$)[0-9]+$/';
preg_match($regexp, $phone); 
}*/





if(!function_exists('setLevel')) {
function setLevel($value) {
     //kolla att level endst innehåller 0 1 eller 2
}
   
}



        //*************KOLLAR ATT DET ÄR EN EMAIL***************//
 
 if (!function_exists('isEmail')) {
        function isEmail($value){
        $email = filter_var($value, FILTER_SANITIZE_EMAIL);
        global $errors;

           // echo'körs isEmail ';
            if (strpos($email, "@") === false){
        $errors[]= $value.'Det där verkar inte vara en epost-adress';
    }else{
               // echo'filtrerad '.$email;
            }
     
        }}

  if (!function_exists('minLength')) {
  function minLength() {
    $value = $_POST[$field];
 
    if(!isset($value[5])) {
        $errors[]= $value.'Fältet innehåller för få tecken!';
        global $errors;
    }
    }
}
  

  if (!function_exists('toLowerCase')) {        
function toLowerCase($value) {
    $str = $value;
    $str = strtolower($str);
   
    }
}
    
    
$validate = array();

    //$validate['fname'] = array('notEmpty' /*, 'validChars','maxChars',*/ );
    //$validate['lname'] = array('notEmpty' /*, 'validChars','maxChars',*/);
    //$validate['adress1'] = array('notEmpty' /*, 'validAdress'*/);
    //$validate['adress2'] = array('notEmpty'/*, 'validAdress'*/);
    //$validate['zipcode'] = array('validZip',/*'isNumbers'*/);
    //$validate['city'] = array('notEmpty'/*, 'validChars'*/);
    //$validate['telefon'] = array('notEmpty', /*'isNumbers',*/ 'isPhone');
    $validate['email'] = array('isEmail', 'notEmpty', 'toLowerCase');
    //$validate['level'] = array('notEmpty'/*, 'isNumbers'*/);
    //$validate['input-password'] = array('notEmpty'/*, 'isPassword'*/);
    //$validate['confirm_password'] = array('notEmpty'/*, 'isPassword'*/ );
                

    /*if($person->isLoggedIn()) {
        $validate['level'] = array('notEmpty', 'isNumbers');
            } else {

                $validate['level'] = array();
   }*/




    foreach ($validate as $field => $rules) {

            
        foreach($rules as $rule) {

            $rule($_POST[$field]);


            
        }

    }
        
 }