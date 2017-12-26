<?php       
$pagecontent = new stdClass;
$pagecontent->title = "Checkout";
include('meny_controller.php');
//include('includes/token.php');


//getToken();


    $idsInCart = array_keys($_SESSION['cart']);
    $idsInCart = implode(array_filter($idsInCart), ',');
    $totalSum = 0;
    $momsSats = 0;

            $sql = "SELECT * FROM product, product_img 
                    WHERE product.product_id = product_img.product_id AND product.product_id 
                    IN ($idsInCart)";


            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $theLastProduct = null;

    while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
            $theLastProduct = $product;


    //skapa $theLastProduct för att kunna spara informationen från senaste hämtade raden.
            $currprod = array();
            $currprod['qty'] = $_SESSION ['cart'][$product['product_id']];
            $currprod['title'] = $product['title'];
            $currprod['product_id'] = $product['product_id'];         
            $currprod['price'] = $product['price'];
            $currprod['img_url'] = $product['img_url'];
            $currprod['sum']= $currprod['price'] * $currprod['qty'];
            $currprod['moms'] = $currprod['sum'] * 0.2;
            $totalSum += $currprod['sum'];
            $momsSats += $currprod['moms'];


            $pagecontent->products[] = $currprod; 

            $cart['cartItems'][$product['product_id']]=$currprod;
       
		

while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$theLastProduct = $product;
    
//skapa $theLastProduct för att kunna spara informationen från senaste hämtade raden.
		$currprod = array();
        $currprod['qty'] = $_SESSION ['cart'][$product['product_id']];
		$currprod['title'] = $product['title'];
		$currprod['product_id'] = $product['product_id'];         
		$currprod['price'] = $product['price'];
		$currprod['img_url'] = $product['img_url'];
        $currprod['sum']= $currprod['price'] * $currprod['qty'];
        $currprod['moms'] = $currprod['sum'] * 0.2;
        $totalSum += $currprod['sum'];
        $momsSats += $currprod['moms'];
        
        
		$pagecontent->products[] = $currprod; 
        
        $cart['cartItems'][$product['product_id']]=$currprod;
}       
            $pagecontent->checkout['product_id'] = $theLastProduct['product_id'];
            $pagecontent->checkout['img'] = $theLastProduct['img_url'];
            $pagecontent->checkout['title'] = $theLastProduct['title'];

//spara $product i $theLastProduct för att det skall finnas kvar när while loopen är körd och $product då blir false.

//hämtar info från inloggad person - för att trycka in i formuläret
        if (isset($_POST['place-order'])) {
            
//Kolla om användaren är inloggad 
        if ($person->isLoggedIn()) {
                    
//OM INLOGGAD - hämtar info från person  
     $person->getUserInfoFromDB();

    }
          
} 

}
    
require ('templates/checkout_tpl.php');