<?php
/*echo 'Logiken för att inserta i databasen profil ändringar.';
echo "<pre>";
var_dump($_POST);
echo "<pre>";
var_dump($_SESSION);

echo "<pre>";
var_dump($_SESSION['personId']);
var_dump($id);
*/

$id= $_SESSION['personId'];

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$adress1 = $_POST['adress1'];
$adress2 = $_POST['adress2'];
$zipcode = $_POST['zipcode'];
$city = $_POST['city'];
$phone = $_POST['tel'];

$sql =  "UPDATE person 
        SET fname = :fname,
             lname =  :lname,
             email = :email,
             street1 = :street1,
             street2 = :street2,
             zip = :zipcode,
             city = :city,
             phone = :phone,
             updated_at = NOW()
        
        WHERE person_id = :id";

$stmt = $pdo->prepare($sql);

$stmt ->bindParam(':id', $id);
$stmt ->bindParam(':fname', $fname);
$stmt ->bindParam(':lname', $lname);
$stmt ->bindParam(':email', $email);
$stmt ->bindParam(':street1', $adress1);
$stmt ->bindParam(':street2', $adress2);
$stmt ->bindParam(':zipcode', $zipcode);
$stmt ->bindParam(':city', $city);
$stmt ->bindParam(':phone', $phone);

$stmt->execute();
/*    
var_dump($stmt);
var_dump($stmt->execute());
var_dump($stmt->errorInfo());

*/
/*$sql =  "UPDATE person 
        SET (fname =  '{$_POST['fname']}',
             lname =  '{$_POST['lname']}',
             email = '{$_POST['email']}',
             street1 =  '{$_POST['adress1']}',
             street2 = '{$_POST['adress2']}',
             zip =  '{$_POST['zipcode']}',
             city = '{$_POST['city']}',
             phone =  '{$_POST['tel']}',
             updated_at = NOW())
        WHERE person_id = $id";


    $stmt = $pdo->prepare($sql);
    $stmt->execute();
*/

// echo a message to say the UPDATE succeeded
echo'<pre>';
    echo $stmt->rowCount() . " records UPDATED successfully";
header("Location:?action=login");
