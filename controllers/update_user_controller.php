<?php 
$pagecontent = new stdClass;
$pagecontent->title= "Redigera användare";
$pagecontent->h2 = "";
require('templates/header.php');
include('meny_controller.php');
require_once('classes/Customer_class.php');
include('includes/validations.php');
echo "errors :";
$errors = array();

//KOLLA OM KNAPPEN DELETE TRYCKTS. KÖR ISF DEN HÄR FÖR ATT TA BORT ANVÄNDARE
if (isset($_POST['delete_button']) && $errors === array() ) {

	$user = new Customer();
	$accountToDelete = $_POST['person_id'];
    $user->setId($accountToDelete);
    $user->deleteAccount($accountToDelete);

    $result["fname"] ="";
    $result["lname"] ="";
    $result["street1"] ="";
    $result["street2"] ="";
    $result["zip"] ="";
    $result["city"] ="";
    $result["phone"] ="";
    $result["email"] ="";
    $result["level"] ="";
    $result["newletter"] ="";

    $pagecontent->h2 = "DU HAR INAKTIVERAT ANVÄNDARE MED ID NR $accountToDelete";

    require('templates/edit_user_tpl.php');



} else {  //****************UPPDATERA ANVÄNDARES KONTO******************************/

if (!$_POST['person_id'] == "" ){

$validate = array();

    $validate['fname'] = array('stripString','notEmpty' , 'validChars');
    $validate['lname'] = array('stripString','notEmpty', 'validChars');
    $validate['adress1'] = array('stripString','notEmpty');
    $validate['adress2'] = array('stripString','validChars'/*'notEmpty'*/);
    $validate['zipcode'] = array('stripString','validZip','isNumbers');
    $validate['city'] = array('stripString','notEmpty', 'validChars');
    $validate['telefon'] = array('stripString','notEmpty','isNumbers', 'isPhone');
    $validate['email'] = array('stripString','isEmail', 'notEmpty'/*'toLowerCase'*/);
                

    if($person->isLoggedIn()) {
        $validate['level'] = array('notEmpty', 'isNumbers', 'setLevel');
            } else {

                $validate['level'] = array();
    }

    foreach ($validate as $field => $rules) {

            
        foreach($rules as $rule) {

            $rule($_POST[$field]);

  
        }

}

	$sql = "UPDATE person SET fname = :fname, lname = :lname,  street1 = :street1, street2 = :street2, zip = :zip, city = :city, phone = :phone, email = :email, updated_at = NOW(), level = :level, newletter = :newletter WHERE person.person_id = :id";


		$stmt= $pdo->prepare($sql);

		    $fname = $_POST['fname'];
			$lname = $_POST['lname'];
			$adress1 = $_POST['adress1'];
			$adress2 = $_POST['adress2'];
			$zip = $_POST['zipcode'];
			$city = $_POST['city'];
			$phone = $_POST['telefon'];
			$email = $_POST['email'];
			$level = $_POST['level'];
			$newletter = $_POST['newletter'];
			$userToChange = $_POST['person_id'];

            $fname = /*removeNationalChars(removeCaps(*/stripString($_POST['fname']);
            $lname = stripString($_POST['lname']);
            $adress1 = stripString($_POST['adress1']);
            $adress2 = stripString($_POST['adress2']);
            $zip = stripString($_POST['zipcode']);
            $city = stripString($_POST['city']);
            $phone = stripString($_POST['telefon']);
            $email = stripString($_POST['email']);

        
            $stmt ->bindParam(':fname', $fname);
            $stmt ->bindParam(':lname', $lname);
            $stmt ->bindParam(':street1', $adress1);
            $stmt ->bindParam(':street2', $adress2);
            $stmt ->bindParam(':zip', $zip);
            $stmt ->bindParam(':city', $city);
            $stmt ->bindParam(':phone', $phone);
            $stmt ->bindParam(':email', $email);
            $stmt ->bindParam(':level', $level);
            $stmt ->bindParam(':newletter', $newletter);
            $stmt ->bindParam(':id', $userToChange);

            $stmt->execute();

        $pagecontent->h2 ="KONTOT ÄR NU UPPDATERAT";

        if($stmt->rowCount() > 0 ) {


        	$result['fname'] = $_POST['fname'];
			$result['lname'] = $_POST['lname'];
			$result['street1'] = $_POST['adress1'];
			$result['street2'] = $_POST['adress2'];
			$result['zip'] = $_POST['zipcode'];
			$result['city'] = $_POST['city'];
			$result['phone'] = $_POST['telefon'];
			$result['email'] = $_POST['email'];
			$result['level'] = $_POST['level'];
			$result['newletter'] = $_POST['newletter'];
                    
            require('templates/edit_user_tpl.php');

            $pagecontent->button ="LISTA PÅ ANVÄNDARE";
            
            require('templates/parts/button_users.php');


				
				}  else {
					
					$pagecontent->h2 ='OJ, NÅGOT GICK VISST FEL!';
				}
	}
}//END ELSE