<?php
require_once('classes/Customer_class.php');
include('meny_controller.php');

//$id = $_SESSION['personId'];
$accountToDelete = $_SESSION['personId'];
//echo"Session Id --- accountToDelete";
//echo($accountToDelete);

//Kontorlerar om avbryt-knappen har tryckts, då återgår till profilsida
if (isset($_POST['cancel'])){
    header("Location:?action=login");
}
//Kontrolerar om radera-knappen har tryckts
if (isset($_POST['delete'])){
// För att slänga den aktulla inloggade användaren:
    $user = new Customer();
    $user->setId($accountToDelete);
    $user->deleteAccount();
    $person->logOut();
    //include('templates/parts/thanks_delete_tpl.php');
    header("Location:?action=delete_permanent_profile");

}

require_once('templates/delete_profile_tpl.php');

