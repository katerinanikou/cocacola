<?php require_once('templates/header.php');

?>
<link type="text/css" rel="stylesheet" href="css/product_single.css">
<!--SINGEL PRODUKT SIDA-->
<div class="product_single">
     
    <!--STOR PRODUKT BILD-->
    <div class="single_img_wrapper">
  <figure>
    <img src="<?php echo $pagecontent->img_url;?>" class="single_img">
  </figure>

    </div>
    
 <div class="prod_info_wrapper">
    <!--PRODUKT TITEL-->
        <hgroup>
            <h2 class="product_title"><?php echo $pagecontent->title;?></h2>
       </hgroup>

        <!--PRODUKTPRIS-->
        <span class="product_price"><?php echo $pagecontent->price.' KR'; ?></span>

           <!--KNAPP TILL VARUKORG-->  
    <form method="post" action="?action=addtocart">
        <input type="hidden" value="<?php echo $pagecontent->price;?>" name="price">
        <label for="cart_qty">Välj antal:</label>
        <input type="text" value="1" id="cart_qty" name="qty">
        <input type="hidden" name="pid" value="<?php echo $pagecontent->pid;?>">
        <!--<input type="hidden" name="cart-token">-->
        <button type="submit" id="single-prod-button">Lägg i varukorg</button>
    </form>

    <!--PRODUKT DETALJER-->
     <div>
        <p class="product_details"><?php echo $pagecontent->description;?></p>
      <div class="share-prod">
          <a href="http://www.facebook.com"><span id="fb-font"></span></a>
          <a href="http://www.instagram.com"><span id="inst-font"></span></a>
          <a href="http://www.pinterest.com"><span id="pint-font"></span></a>
          <a href="mailto:info@millhouse.se&subject=" data-email="info@millhouse.se"><span id="mail-font"></span></a>
        </div>
     </div>
     
     <!--META TAGGAR-->

        <meta property="og:url" content="millhouse/sajten....." />
        <meta property="og:type" content="product" />
        <meta property="og:title" content="<?php echo $pagecontent->title;?>" />
        <meta property="og:description" content="<?php echo $pagecontent->description;?> "/>
        <meta property="og:image" content="<?php echo $pagecontent->img_url;?> " />
     </div>

     <!--LIKNANDE PRODUKTER-->
<div class="product_upsale">
<h2 class="upsale_title">Liknande produkter</h2>
</div>
    <hr>
<div class="product_upsale">
        <?php foreach ($pagecontent2->products as $currprod2) {
    echo '<a href="?action=product&pid='.$currprod2['product_id_2'].'"><div class="product_wrapper_upsale">';
    echo '<img src="'.$currprod2['img_url_2'].'" class="prod_img_upsale">';
    echo '<h4>'.$currprod2['title_2'].'</h4>';
    echo '<p class ="price_upsale">'.$currprod2['price_2'] .' KR'.'</p>';
    echo '<a href="?action=product&pid='.$currprod2['product_id_2'].'" class="upsale-button-a"><button class="button-upsale" type="button">KÖP</button></a>';
    echo '</div></a>';
    } ?>
</div>
 
</div>
</div>

<?php require_once('templates/footer.php');
?>