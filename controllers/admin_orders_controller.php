<?php
include('meny_controller.php');

$pagecontent = new stdClass;
$pagecontent->title = "Alla ordrar";


/*****Hämtar och visar alla ordrar*****/
if (($_GET['action'] === 'orders') ||($_GET['action'] === 'searchOrder') ){
    //Logiken om tryckt på sök knappen
    if($_GET['action'] === 'searchOrder' && $_POST['order_search'] !== ""){ 
        if (isset($_POST['order_search'])){
            /****************** HÄR HÄMTAS SÖKRESULTATET ******************/
              $sql1 = "SELECT * FROM orders WHERE order_id = :id;";         
                $stmt1 = $pdo->prepare($sql1);
                $stmt1->bindParam(':id', $_POST['order_search']);
                $stmt1->execute();
                $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
                $pagecontent->title = "Sökresultat";
            }
        
    } else {
            // Hämtar alla ordrar
            $sql1 = "SELECT  * FROM orders;";         
                $stmt1 = $pdo->prepare($sql1);
                $stmt1->execute();
                $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

        // Hämta statusar till <select><options>
        $sql = "SELECT * FROM order_status";    
            $stmt = $pdo->prepare($sql);
            $stmt->execute();  
            $result = $stmt->fetchAll();

        //Vi skapar en array för att lägga reultatet av sql i
        $pagecontent->status = array();

        // loopar över resultatet och lägger in i arrayen $pagecontent->status
        foreach ($result as $status) {
            $currstatus = array();
            $currstatus['title'] = $status['title'];
            $currstatus['status_id'] = $status['order_status_id'];
            $pagecontent->status[] = $currstatus;
        }

 if (!empty($result1)){
        //Loppar vi över $result1 och varje element i resultat blir $order
        foreach ($result1 as $orderRow){
            // Skappar vi en tom array där vi placerar element från $order som vi loopar över
            $currorder = array();
            $currorder['Datum'] = $orderRow['created_at'];
            $currorder['OrderNr'] = $orderRow['order_id'];
            $currorder['Person_id'] = $orderRow['person_id'];
            $currorder['Payement_id'] = $orderRow['payment_id'];
            $currorder['Shipper_id'] = $orderRow['shipper_id'];
            $currorder['Status'] = $orderRow['order_status_id'];
           
            //Allt som ligger i $currorder läggs i $pagecontent->order[] som vi skapar. 
            $pagecontent->orders[] = $currorder;
        }

            //Här trycker vi in allt i $pagecontent
            $pagecontent->Datum = $orderRow['created_at'];
            $pagecontent->OrderNr = $orderRow['order_id'];
            $pagecontent->Person_id = $orderRow['person_id'];
            $pagecontent->Payement_id = $orderRow['payment_id'];
            $pagecontent->Shipper_id = $orderRow['shipper_id'];
            $pagecontent->Status = $orderRow['order_status_id'];
        }  

    require('templates/admin_order_tpl.php');

}
/*****Visar detaljer för en specifik orderr*****/
if ($_GET['action'] === 'singleOrder'){
  
    $sql = "SELECT * FROM order_items WHERE order_id = :oid;";         
    $stmt = $pdo->prepare($sql);
    $stmt ->bindParam(':oid', $_GET['oid']);
    $stmt->execute();
    $result = $stmt->fetchAll();
   // echo '<pre>';
    //
    //var_dump($result);
        $totalsumma = 0;
        foreach ($result as $orderItemRow){
            // Skappar vi en tom array där vi placerar element från $order som vi loopar över
            
            $currItem = array();
            $currItem['OrderNr'] = $orderItemRow['order_id'];
            //$currItem['Artikel_id'] = $orderItemRow['order_items_id'];
            $currItem['Produkt_id'] = $orderItemRow['product_id'];
            $currItem['Pris'] = $orderItemRow['price'];
            $currItem['Antal'] = $orderItemRow['quantity'];        
            $currItem['Total'] = $orderItemRow['price'] *  $orderItemRow['quantity']; 
            $totalsumma += $currItem['Total'];
            //Allt som ligger i $currorder läggs i $pagecontent->order[] som vi skapar. 
            $pagecontent->orderItems[] = $currItem;
        }

            //Här trycker vi in allt i $pagecontent
            $pagecontent->OrderNr = $orderItemRow['order_id'];
           // $pagecontent->Artikel_id = $orderItemRow['order_items_id'];
            $pagecontent->Produkt_id = $orderItemRow['product_id'];
            $pagecontent->Pris = $orderItemRow['price'];
            $pagecontent->Antal = $orderItemRow['quantity'];
            $pagecontent->Total = $orderItemRow['price'] *  $orderItemRow['quantity']; 
    
    
    require('templates/admin_singleOrder_tpl.php'); 
    
     $sql1 = "SELECT  * FROM
                    (SELECT created_at as datum, orders.order_id, title as status
                    FROM orders, order_status, order_items
                    WHERE orders.order_status_id = order_status.order_status_id
                    AND orders.order_id = order_items.order_id = :oid
                    GROUP BY orders.order_id) AS t1
                    INNER JOIN
                    (SELECT order_id, SUM(price*quantity)
                    FROM order_items
                    GROUP BY order_id) AS t2
                    ON t1.order_id = t2.order_id;";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1 ->bindParam(':oid', $_GET['oid']);
        $stmt1->execute();
        // var_dump($stmt1->errorInfo());
        
        $result1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
       // var_dump($result1);
    
    
    
}

if ($_GET['action'] === 'updateOrderStatus'){
    
/************** UPPDATERAR DB MED ORDERSTATUS  ****************/

$oid = $_GET['oid'];

    // Om man har tryckt på knappen uppdatera finns updateStatus i $_POST
    if (array_key_exists('updateStatus', $_POST)){
        
        $sql = "UPDATE orders SET order_status_id = :order_status, updated_at = NOW() WHERE order_id = :order_id";
        $stmt = $pdo->prepare($sql);
        $status = $_POST['status']['order'];
        $stmt->bindParam(':order_id', $oid);
        $stmt->bindParam(':order_status', $status);
        $stmt->execute();
        
    /****************** SKICKA EMAIL MED STATUS ******************/
        
    $sql = "SELECT title FROM order_status WHERE order_status_id = :order_status";    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':order_status', $status);
    $stmt->execute();  
    $result = $stmt->fetch();

    // the message
    $msg = "Hej!\n Din order är nu ".strtolower($result['title'])."! \n Vänligen, Lorenzo Granza";
    
    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    // send email
    mail("someone@example.com","Din order",$msg);
    //echo $msg;

    }
     header("Location:?action=orders");
}
