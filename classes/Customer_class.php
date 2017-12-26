<?php
// Class customer ärver från class person

// Det kan vara en bra idé att göra require_once på basklassens fil vid extends.
// require_once('Person_class.php');

class Customer extends Person{
    // Function för radera kontot / avaktivera
    
    // Vet inte om du måste ha ett anrop till parent::__construct när du gör extend.
    public function __construct() {
       // parent::__construct();
    }
    
    public function deleteAccount($id){
        global $pdo;
        $email = $adress1 = $adress2 = $zipcode = $city = $phone = null;
        $active = 0;
        $sql =  "UPDATE person 
                SET  email = :email,
                     street1 = :street1,
                     street2 = :street2,
                     zip = :zipcode,
                     city = :city,
                     phone = :phone,
                     active = :active,
                     updated_at = NOW()
                WHERE person_id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt ->bindParam(':id', $this->personId);
        $stmt ->bindParam(':email', $email);
        $stmt ->bindParam(':street1', $adress1);
        $stmt ->bindParam(':street2', $adress2);
        $stmt ->bindParam(':zipcode', $zipcode);
        $stmt ->bindParam(':city', $city);
        $stmt ->bindParam(':phone', $phone);
        $stmt ->bindParam(':active', $active);
        $stmt->execute();
        
        //var_dump($stmt->errorInfo());


//echo a message to say the UPDATE succeeded
    echo'<pre>';
    echo $stmt->rowCount() . " records UPDATED successfully";
    echo'</pre>';   
    //require_once('templates/parts/thanks_delete_tpl.php');
     
    }
    // En function som ska hämta ordrar och visa de på kundens sida
    public function getOrders(){
        global $pdo;
        // Här hämtas datum, status på order och total summa på ordern för en viss person.
       $sql1 = "SELECT  * FROM
                    (SELECT created_at as datum, orders.order_id, title as status
                    FROM orders, order_status, order_items
                    WHERE orders.order_status_id = order_status.order_status_id
                    AND orders.order_id = order_items.order_id
                    AND person_id = :id
                    GROUP BY orders.order_id) AS t1
                    INNER JOIN
                    (SELECT order_id, SUM(price*quantity)
                    FROM order_items
                    GROUP BY order_id) AS t2
                    ON t1.order_id = t2.order_id;";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->bindParam(':id', $this->personId);
        $stmt1->execute();
        // var_dump($stmt1->errorInfo());
        
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
        return $result1;
        }
}
        
        
