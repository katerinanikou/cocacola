	<?php
$pagecontent= new stdClass;
include('meny_controller.php');
require('templates/header.php');
include('includes/validations.php');

$errors = array();
	
	$pagecontent->title ="REDIGERA KONTO";
	$pagecontent->h2 ="REDIGERA KONTO FÖR ID ".$_GET['uid'];


//SÄTT GET TILL ANVÄNDARE VARS KONTO SKALL UPPDATERAS
if(isset($_GET['uid'])) {

$userToChange = $_GET['uid'];

//HÄMTA ALL INFO OM DENNA FR DB OCH LÄS IN I FORMULÄRET
$sql= "SELECT * FROM person WHERE person_id = {$userToChange}";
$stmt=$pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();


}
require('templates/edit_user_tpl.php');
require('templates/footer.php');



