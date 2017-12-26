<?php
require('templates/header.php');
?>

<link type="text/css" href="css/cart.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--Här är vår varukorg.-->
<div id="cart-wrapper">
<p class="kundvagn">Din kundvagn</p>
<hr id="hr-cart">

<form method="post" action="?action=updatecart" id="update-cart-form">
    
<div class="cart-content">
    <?php if (!array_key_exists('cartItems', $cart)){
        print '<p id="empty-cart">Din varukorg är tom!</p>';
            
};?>
    <?php if (isset($cart['cartItems'])):
    foreach ($cart['cartItems'] as $cartItemPid => $cartItemData): ?>
        
<div class="item">
        <div class="delete-icon">
        <a href="?action=removecartitem&pid=<?php echo $cartItemPid;?>">
        <span class="tabort"></span>
        </a>
    </div>
                
    <div class="item-img">
        <img id="cart_img" src="<?php echo $cartItemData['img_url'];?>">
    </div>
                
    <div class="item-title">
        <span class="desc"><?php echo $cartItemData['title'];?></span>
    </div>
                
    <div class="item-qty">
        <input type="number" name="cartitems[<?php echo $cartItemPid;?>]" value="<?php echo $cartItemData['qty'];?>">
    </div>
                
    <div class="item-price">
        <?php echo $cartItemData['price'].' KR';?>
    </div>
                
    <div class="cart-sum">
        <?php echo $cartItemData['sum'].' KR';?>
    </div>
</div>
        
<?php endforeach ?>
<?php endif ?>
        
  
        
<div id="cart-total">       
<div class="totalen">
    <?php echo 'Summa varor';?>
</div>
                
<div class="cart-total">
    <?php echo $cart['total'].' KR';?>
    <br>
    <button class="update-cart-btn" type="submit">
                            Uppdatera varukorgen</button> 
</div>
</div>                  
                     
</div> 
            
</form>
    
     <div class="btn-box">
        <form method="post" action="?action=checkout" name="form-checkout-btn">
            <button type="submit" id="checkoutknapp" name="place-order" 
            value="<?php $cartItemData;?>">Lägg order</button>
         </form>
    </div>
 </div>    
<?php 
require_once('templates/footer.php');
?>