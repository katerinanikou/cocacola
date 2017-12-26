<?php
// Skapa en cartarray

$cart = array();
if (isset($_SESSION['cart'])){
// Plockar ut nycklarna i $_SESSION och trycker in ett , mellan alla id:n.
$idsInCart = array_keys($_SESSION['cart']);
$idsInCart = implode(array_filter($idsInCart), ',');


$sql = "SELECT * FROM product, product_img WHERE product.product_id = product_img.product_id AND product.product_id 
        IN ($idsInCart)";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();

$totalSum = 0;


// VARJE RAD I LOOPEN ÄR EN PRODUKT IFRÅN $RESULT SOM VI LÄGGER IN I EN NYSKAPAD ARRAY $PROD.

foreach ($result as $product){
    
    $prod= array();
    $prod['qty'] = $_SESSION['cart'][$product['product_id']];
    $prod['img_url'] = $product ['img_url'];
    $prod['price'] = $product['price'];
    $prod['title'] = $product['title'];
    $prod['sum'] = $prod['price'] * $prod['qty'];
    $totalSum += $prod['sum'];
    
    $cart['cartItems'][$product['product_id']] = $prod;
}


// Vi sparar totalsumman i $cart['total'].

$cart['total'] = $totalSum;
}
?>