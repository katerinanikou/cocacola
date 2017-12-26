<?php
include('meny_controller.php');
//Trycker in formulärdata till adress2 ifall gästen valt en annan leveransadress

$pagecontent = new stdClass;
$pagecontent->title = "Tack!";


 if (!empty($_POST['street12'])) {
    
             $sql2 = "INSERT INTO adress2 (fname, lname, street1, street2, zip, city) 
                    VALUES (:fname2, :lname2, :street12, :street22, :zip2, :city2)";
 
            $stmt = $pdo->prepare($sql2);
    
//Binder ihop förfrågan med info från formuläret
     
            $fname = $_POST['fname2'];
            $lname = $_POST['lname2'];
            $adress1 = $_POST['street12'];
            $adress2 = $_POST['street22'];
            $zip = $_POST['zip2'];
            $city = $_POST['city2'];
            
  
            $stmt ->bindParam(':fname2', $fname);
            $stmt ->bindParam(':lname2', $lname);
            $stmt ->bindParam(':street12', $adress1);
            $stmt ->bindParam(':street22', $adress2);
            $stmt ->bindParam(':zip2', $zip);
            $stmt ->bindParam(':city2', $city);
            
   //skickar förfrågan till databasen
            $stmt->execute();
     //Trycker in all info från formulär till person
            $lastId2 = $pdo->lastInsertId(); 


}
//kontrollerar att Bekräfta köp har tryckts på

if(in_array('placeorder',$_POST)) {
     global $pdo;
   
    //Om person ej är inloggad
      if(!$person->isLoggedIn()) {   

//Skapar förfrågan för att lägga in information från formuläret i PERSON DB
          
            $sql1 = "INSERT INTO person (fname, lname, street1, street2, zip, city, phone, email, created_at)
            VALUES (:fname, :lname, :street1, :street2, :zip, :city, :phone, :email, NOW())";
 
            $stmt = $pdo->prepare($sql1);
    
//Binder ihop förfrågan med info från formuläret
     
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $adress1 = $_POST['street1'];
            $adress2 = $_POST['street2'];
            $zip = $_POST['zip'];
            $city = $_POST['city'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
  
        
            $stmt ->bindParam(':fname', $fname);
            $stmt ->bindParam(':lname', $lname);
            $stmt ->bindParam(':street1', $adress1);
            $stmt ->bindParam(':street2', $adress2);
            $stmt ->bindParam(':zip', $zip);
            $stmt ->bindParam(':city', $city);
            $stmt ->bindParam(':phone', $phone);
            $stmt ->bindParam(':email', $email);
		
//skickar förfrågan till databasen
            $stmt->execute();
//Trycker in all info från formulär till person
            $lastId = $pdo->lastInsertId();
        }
//Order skapas här 
    
              $sql4 = "INSERT INTO orders (person_id, shipper_id, payment_id, adress2_id)
                        VALUES (:personId, :shipping_option, :payment_option, :adress2_id)";
              
              $stmt = $pdo->prepare($sql4); 
              // personId hämtas olika beroende på om person är inloggad eller ej.
            if ($person->isLoggedIn()) {
                $personId = $_SESSION['personId'];
            }       
            else {
                $personId = $lastId;
            }
                $shipping = $_POST['shipping_option'];
                $payment = $_POST['payment_option'];

                $stmt->bindParam(':personId', $personId);
                $stmt->bindParam(':shipping_option', $shipping);
                $stmt->bindParam(':payment_option', $payment);
                $stmt->bindParam(':adress2_id', $lastId2);

                $stmt->execute();

                $lastId4 = $pdo->lastInsertId();

//Order_items skapas här
            
        foreach ($_SESSION['cart'] as $pid => $qty){ 
                $price = $_SESSION['price'][$pid];                   

                $sql5 = "INSERT INTO order_items (order_id, product_id, quantity, price)
                        VALUES (:order_id, :product_id, :qty, :price)";

                $stmt = $pdo->prepare($sql5);$stmt->bindParam(':order_id', $lastId4);
                $stmt->bindParam(':product_id', $pid);
                $stmt->bindParam(':qty', $qty);
                $stmt->bindParam(':price', $price);
                $stmt->execute();
            }
        
}
 /*else {
    header('Location:?action=default');
 }*/


$_SESSION['cart-total'] = 0;
unset($_SESSION['cart']);

include('templates/thank_you_tpl.php');
?>