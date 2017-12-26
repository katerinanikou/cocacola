<?php //------------------Trycker in formulärdata till adress2 ifall gästen valt en annan leveransadress------------------

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
            
if (checkToken($_POST['token']))  {
     //skickar förfrågan till databasen
            $stmt->execute();
     //Trycker in all info från formulär till person
            $lastId2 = $pdo->lastInsertId(); 

}

?>