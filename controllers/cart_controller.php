<?php
include('meny_controller.php');

$pagecontent = new stdClass; 
$pagecontent->title = "Din kundvagn";
$total = 0;


if ($_GET['action'] === 'addtocart' && !empty($_POST['pid'])){
    // Här hämtas pid från $pagecontent som hämtas av $_POST på produktsidan och läggs i variabeln $pid.
    $pid = $_POST['pid'];
    $qty = $_POST['qty'];
    $price = $_POST['price'];
    // Här är ett test för att kolla om produkten man vill lägga till i varukorgen redan finns. 
    // Om ja- plussas antalet med antalet som redan finns.
    // Om inte- läggs det i varukorgen.
    
   if (array_key_exists($pid, $_SESSION['cart'])){
        $_SESSION['cart'][$pid] += $qty;
        
    } else {
        $_SESSION['price'][$pid] = $price;
        $_SESSION['cart'][$pid] = $qty;
    }
       
}
// vi måste ha med en pid för att kunna ta bort den aktuella varan.
// det som ska unsettas är pid inte hela $_SESSION.
if ($_GET['action'] === 'removecartitem' && isset($_GET['pid'])){
    unset($_SESSION['cart'][$_GET['pid']]);
    unset($_SESSION['price'][$_GET['pid']]);
}

if ($_GET['action'] === 'updatecart'){
    foreach ($_POST['cartitems'] as $pid => $qty){
    if ($qty < 1){
    unset($_SESSION['cart'][$pid]);
    
    } else {
        $_SESSION['cart'][$pid] = $qty;
    }
}
  
}

/*** UPPDATERAR VARUKORGSIKONEN MED ANTAL PRODUKTER I CART ****/

foreach($_SESSION['cart'] as $pid => $currqty){
    $total += $currqty;
}

$_SESSION['cart-total'] = $total;


require_once('includes/cart.php');
include('templates/parts/cart_tpl.php');
// Skickas tillbaka till samma sida som vi kom ifrån.
//$refererURL = $_SERVER['HTTP_REFERER'];
//header("Location:$refererURL");