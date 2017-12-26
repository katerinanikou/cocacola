<!DOCTYPE html>
<html>
<head>
<title>Granza perfumes | <?php echo $pagecontent->title; ?></title>
<link rel="shortcut icon" href="img/logo/granza.png"/>
<link type="text/css" rel="stylesheet" href="css/header.css">
<link type="text/css" rel="stylesheet" href="css/footer.css">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,800|Work+Sans:300,400" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">  

</head>
<body>
<!--HEADER-->
<header>

    <!--MENY SOM FÄLLS UT-->
      <input type="checkbox" id="nav-trigger" class="nav-trigger">
        <label for="nav-trigger" class="toggle">☰</label>
        <nav class="menu">
            <h1 id="menu-button">Meny</h1>
            
            <ul class="ulmenu">    
                <li><a href="?action=category&id=1">Damdofter</a></li>
                <li><a href="?action=category&id=2">Herrdofter</a></li>
                <li><a href="?action=about-us">Om oss</a></li>
                <li><a href="?action=about-us">FAQ</a></li>
            </ul>
        </nav>
    
    <!--LOGOTYP-->
    <div class="div_logo">
        <a href="?action=default">
        <img src="img/logo/granza.png" alt="logotype granza" id="id_logo"></a>
    </div>
    
    <!--IKONER TILL MIN PROFIL & SHOPPING BAG-->
    <div class="menu_icons">
        <a href="?action=login"><span id="profile"></span></a>
        <a href="?action=addtocart">
            <span id="shop_bag">
                <!-- SKRIVER UT ANTALET PRODUKTER I VARUKORGEN -->
              <?php if(isset($_SESSION['cart-total']) && $_SESSION['cart-total'] > 0){
                printf ('<div id="qty-cart"><span id="qty">%s</span></div>', $_SESSION['cart-total']);
            }
                //if(isset ($_POST['checkout'])){
            
             //$_SESSION['cart-total'];
                    //$_SESSION['cart']= null;
                    //echo'hejehje ABBE'
                
                
                ?>
            </span></a>
    </div>  
</header>