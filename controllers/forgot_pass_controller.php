<?php

$pagecontent = new stdClass;
$randomString ="";
$email ="";
$password ="";
$pagecontent->h2 = "";
$pagecontent->h2 = "ANGE DIN EMAIL FÖR NYTT LÖSENORD HÄR";


if (in_array('forgot_password', $_GET) ) {

    include('templates/parts/forgot_password_tpl.php');

$pagecontent->h2 = "ANGE DIN EMAIL FÖR NYTT LÖSENORD HÄR";
/****************** SKAPA RANDOM PASSWORD ******************/
    if (isset($_POST['email']) ) {
     $email = $_POST['email'];

     

         function generateRandomString($length = 10) {
    
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;

}

$password = generateRandomString($length = 10);
//echo $password;

/****************** SKICKA EMAIL ******************/
    // the message
    $msg = "Hej!\nDu har begärt ett nytt lösenord.\nLogga in med det nya här för att ändra det: http://localhost:8888/granza/?action=login . Här är ditt nya lösenord: ".$password;
    
    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
    mail("someone@example.com","Nytt lösenord",$msg);
    echo $msg;

    }
   
/****************** HASHA OCH STOPPA IN I DB ******************/
    $sql = "UPDATE person SET password = :password WHERE person.email = :email";

    $stmt= $pdo->prepare($sql);
    $email = $email;
    $password = hash('sha256', $password);


    $stmt ->bindParam(':password', $password);
    $stmt ->bindParam(':email', $email);
    $stmt->execute();

} //END IF IN ARRAY FORGOT PASSWORD