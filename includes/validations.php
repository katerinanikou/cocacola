<?php
$pagecontent = new stdClass;
$pagecontent ->title = "";

$errors = array();


      if (!function_exists('stripString')) {
         function stripString($value) {

        $string = strip_tags($value);
        // echo"strippad ".$string;

        $html = htmlspecialchars($string);
        //echo"charsad ".$html;
        return $html;
        } 
      }  



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
  //Kollar att det endast är bokstäver stora/små, binderstreck eller mellanslag 

          $regex_name = "/[a-zA-Z]{2,50}$/";

          if (preg_match($regex_name, $value)){

          } else {
            $errors[] = 'Något är knas med ditt namn';
          }
    }
}


if(!function_exists('validZip') ) {
    function validZip($value) {
        
        //KAN INNEHÅLLA MAX 5 SIFFROR

     global $errors;
    

    $regexp ="/^[0-9]{5}$/";     
    $zip = $value; 
    
    $zip = preg_replace('/\s+/', '', $zip);     
 //   echo "HÄJ".$zip; 
        
        if (preg_match($regexp, $zip)) {
        //isNumbers($zip);
//        echo "zip is valid";
    
    } else {

            $errors[] = 'Något är vajsing med zippen';
    }
    }
}

if(!function_exists('isPassword') ) {
    function isPassword($value) {
        //MINST 6 TECKEN, VARAV EN BOKSTAV PLUS MINST EN SIFFRA 

     global $regexp;
     global $errors;
     $password = $value;
     $regexp  = '/^\S*(?=\S{6,})(?=\S*[a-z])(?=\S*[\d])\S*$/';
     
       //echo"pass körs"; 
            if (preg_match($regexp, $password)) {
       
       //echo "password is valid";
    
            } else {

            $errors[] = 'Något är vajsing med ditt lösenord';
    }
    }
}



if (!function_exists('isNumbers')) {        
function isNumbers($value) {
 global $errors;
 //   echo "isnumbers körs ";
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
        //echo "phone is valid";

    } else {

            $errors[] = 'Något är lurt med telefonnumret'." ".$phone;
    }
            
}

} 

if(!function_exists('setLevel')) {
function setLevel($value) {
     //kolla att level endast innehåller 0 1 eller 2
    global $errors;
    $level = $value;

    if(strpos($level, "0") === false && (strpos($level, "1") === false && (strpos($level, "2")  === false) ) ){

        $errors[] = 'Ogiltig level';
    }
    }

}

        //*************KOLLAR ATT DET ÄR EN EMAIL***************//
 
 if (!function_exists('isEmail')) {
        function isEmail($value){
        $email = $value;
        global $errors;

            if (strpos($email, "@") === false){
        $errors[]= $email.'Det där verkar inte vara en epost-adress';
        //function toLowerCase($email);
    } 
    }
 }
  

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
 //} //end if post isset


/* $stmt = $pdo->prepare("INSERT INTO test ... :fname");

 $stmt->bindParam(':fname', $fname);*/  
