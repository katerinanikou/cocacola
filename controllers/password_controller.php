<?php
include('meny_controller.php');
include('includes/token.php');
include('includes/validations.php');

$pagecontent = new stdClass;
$pagecontent->title = "ÄNDRA LÖSENORD";
$pagecontent->h2 = "ANGE ANVÄNDAR-ID";
$newPassword = "";

getToken();


/**** KOLLA OM MAN SÖKT EFTER ANVÄNDAR ID FÖR ATT ÄNDRA ANVÄNDARES PASSWORD ****/


        if (isset($_POST['search_user']) && $_POST['search_user'] === "")  {
    
       $pagecontent->h2 = "ANGE ETT ID";

        } else {


/****************** HÄR HÄMTAS SÖKRESULTATET ******************/
        
        $sql = "SELECT * FROM person
        WHERE person_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $_POST['search_user']);
            $stmt->execute();
            $result = $stmt->fetch();


/****************** KOLLA OM DET FINNS ETT RESULTAT OCH SÄTT VARIABLER************/

        if (count($result) > 1){

            $pagecontent->user_id = $result['person_id'];
            $pagecontent->fname = $result['fname'];
            $pagecontent->lname = $result['lname'];
            
            $pagecontent->h2 = "ANVÄNDAREN HAR ID NR ".$result['person_id']."<br>"." "."OCH HETER ".$result['fname']." ".$result['lname'];
            
             $pagecontent->title;

                $user = new Person();
                
                $userToChange = $_POST['search_user'];

                $user->setId($userToChange);


            } else if (isset($_POST['search_user']) && $result !== TRUE) {

                 $pagecontent->title = "DET ANVÄNDAR-ID DU ANGETT SAKNAS";
            

            }

        if (isset($_POST['new_password']) && strlen($_POST['new_password']) > 0 && $_POST['new_password'] === $_POST['confirm_password'] ) {
            

            $newPassword = htmlentities($_POST['new_password']);
            $newPassword = trim($_POST['new_password']);
            $newPassword = hash('sha256', $newPassword); 

            $user->changePassword($newPassword);


            $pagecontent->title = "LÖSENORDET ÄR NU ÄNDRAT";
            $pagecontent->title;

        }


}//END IF som kör koden om allt stämmer



require('templates/change_password_tpl.php');