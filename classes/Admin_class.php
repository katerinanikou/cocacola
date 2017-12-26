<?php
// Class Admin ärver från class person

// Det kan vara en bra idé att göra require_once på basklassens fil vid extends.
// require_once('Person_class.php');

class Admin extends Person{
   
    // Vet inte om du måste ha ett anrop till parent::__construct när du gör extend.
    public function __construct() {
       
    }    
    // En function som ska hämta ordrar och visa de på kundens sida.
    public function getAllOrders(){
        global $pdo;
        // Här hämtas datum, status på order och total summa på ordern för en viss person.
        $sql1 = "SELECT  * FROM orders;" ;       
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute();
         var_dump($stmt1->errorInfo());
        
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        return $result1;
        }
}

 	