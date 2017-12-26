<?php require_once('templates/header.php');
;?>

<link type="text/css" href="css/checkout.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1">
 <!--VISA VAD SOM LIGGER I VARUKORG(CART)-->

<!--FORMULÄR ADRESS KOPPLAT TILL PERSON-->

<!--CHECK OUT(KASSA)-->
<!--FORMULÄR ADRESS KOPPLAT TILL PERSON-->
<div id="checkout-wrapper">

<div class="checkout-content">   
    <h2 class="site_title">Leveransuppgifter</h2>
<hr> 
   
    <form action="?action=order" method="post" id="your-info" name="checkout">
    <h3 class= "form-header">Dina uppgifter</h3>
        <input type="text" name="fname"     placeholder="Förnamn"  value="<?php echo $person->getUserInfo('fname');?>">
        <input type="text" name="lname"     placeholder="Efternamn"  value="<?php echo $person->getUserInfo('lname');?>">
        <input type="text" name="street1"   placeholder="Adress"    value="<?php echo $person->getUserInfo('street1');?>">
        <input type="text" name="street2"   placeholder="Adress"    value="<?php echo $person->getUserInfo('street2');?>">
        <input type="text" name="zip"       placeholder="Postnummer" value="<?php echo $person->getUserInfo('zip');?>">
        <input type="text" name="city"      placeholder="Stad"       value="<?php echo $person->getUserInfo('city');?>">
        <input type="text" name="email"     placeholder="E-post"     value="<?php echo $person->getUserInfo('email');?>">
        <input type="text" name="phone"     placeholder="Telefon"    value="<?php echo $person->getUserInfo('phone');?>">
       
    <br>


<!--FORMULÄR ADRESS2 ANNAN LEVERANS ADRESS-->
        <input type="checkbox">Välj en annan leveransadress
            <div id="street2-hidden">
            <h3 class= "form-header">Leveransadress</h3>
                        
            <input type="text" name="fname2"     placeholder="Förnamn">
            <input type="text" name="lname2"     placeholder="Efternamn">
            <input type="text" name="street12"   placeholder="Adress">
            <input type="text" name="street22"   placeholder="Adress">
            <input type="text" name="zip2"       placeholder="Postnummer">
            <input type="text" name="city2"      placeholder="Stad">
            <input type="text" name="phone2"     placeholder="Telefon">

            </div>

        <h2 class="site_title">Betalningsmetod</h2>
<hr>
        <ul class="payment-method">
            <li class ="payment-lista">
                <label>
                <input type="radio" value="1" name="payment_option">Kortbetalning</label>
            </li>
            
            <li class ="payment-lista">
               <label> 
               <input type="radio" value="2" name="payment_option">Paypal</label>
            </li>
            <li class ="payment-lista">
                 <label>
                 <input type="radio" value="3" name="payment_option">Klarna
                 </label>
            </li>
            <li class ="payment-lista">
                <label>
                  <input type="radio" value="4" name="payment_option">Direktbetalning med bank
                </label>
            </li>
        </ul>
 <h2 class="site_title">Fraktsätt</h2>
<hr>
        <ul class="shipping-method">
             <li class="shipping-lista">
               <label>
              <input type="radio" value="2" name="shipping_option"> PostNord (+0SEK)
            <br>Leverans 2-5 arbetsdagar
            </label>
            </li>
            <li class="shipping-lista">
               <label>
                <input type="radio" value="1" name="shipping_option"> DHL Express (+0SEK) 
                 <br> Hemleverans samma dag  
                </label>
             </li>
      </ul>
<hr id ="last-hr">

    </div> 
     <div class="mini-cart">
     <h3 class= "form-header">Dina varor</h3>

    <table>
        <?php foreach ($pagecontent->products as $currprod){
            echo'<tr>';
            echo '<td><img class="checkout-img" src="'.$currprod['img_url'].'" class="prod_img"></td>';
            echo '<td>'.$currprod['title'].'</td>';
            echo '<td>'.$currprod['price'] .' KR'.'</td>';
            echo'<td id="prod-sum">'.$currprod['sum'] .' KR'.'</td>';
            echo'</tr>';

        };
        echo'</table>';
         echo'<div id="to-pay">'.'Att betala '.$totalSum .' KR'.'</div>';
         echo'<div id="moms">'.'varav moms '.ceil($momsSats).' KR'.'</div>';
        ?>

    <!-- FORM TOKEN
    //php echo getTokenField(); -->
    
  <button action="?=order" type="submit" class="btn-placeorder" value="placeorder" name="checkout">checka ut</button>
                </form>
          
</div>
</div>
<?php 
    require_once('templates/footer.php');
?>