<?php include('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>

<link type="text/css" rel="stylesheet" href="css/admin.css">
<link type="text/css" rel="stylesheet" href="css/navbar_admin.css">

<!--ADMIN MENY SOM FÄLLS UT-->
<!--
<nav class="ad_menu">
            <ul class="ad_ulmenu">
                <li class="ad_li"><a href="">PRODUKTER</a> 
                    <ul>
                        <li><a class="menu_link" href="?action=create-product"><li>SKAPA PRODUKT</a></li>
                        <li><a href="?action=edit-product" class="menu_link"><li>REDIGERA PRODUKT</a></li>
                        <li><a href="?action=all-products" class="menu_link"><li>ALLA PRODUKTER</a></li>
                    </ul>    
                 

                <li class="ad_li"><a href="" >KATEGORIER</a>
                    <ul>   
                        <li><a href="?action=create-category" class="menu_link"><li>SKAPA KATEGORI</a></li>
                        <li><a href="?action=edit-category" class="menu_link"><li>REDIGERA KATEGORI</a></li>
                        <li><a href="?action=all-categories" class="menu_link"><li>ALLA KATEGORIER</a></li>
                    </ul>
                <li class="ad_li"><a href="?action=orders">ORDRAR</a>
                
                <li class="ad_li"><a href="">ANVÄNDARE</a>
                    <ul>
                        <li><a href="?action=password" class="menu_link"><li>ÄNDRA LÖSENORD</a></li>
                        <li><a href="?action=create_user" class="menu_link"><li>SKAPA ANVÄNDARE</a></li>
                        <li><a href="?action=users" class="menu_link">ALLA ANVÄNDARE</a></li>
                    </ul>
                <li class="ad_li"><a href="?action=edit-page" >REDIGERA SIDA</a></li>
            </ul>
        </nav>
-->

        <!--MAIN CONTENT STARTAR HÄR-->
<link type="text/css" rel="stylesheet" href="css/admin_header.css">

<div class="main_wrapper">

    <!--BILD-->
    <div class="admin_img_wrapper">
        <img class="admin_img" src="img/inspo/watch_inspo2.jpg">
    </div> 

	<!--TITEL-->

	<hgroup>
		<h2 class="admin_title">
			<?php echo $pagecontent->title; ?> 
		</h2>
	</hgroup>
	



		<!--LOGGA UT-->
	<div class="log_out_wrapper">
		<a href="?action=logout"><button type="submit" id="logout_button">LOGGA UT</button></a>
		<a href="?action=default" class="shop_link" href="">TILL BUTIKEN</a>
	</div>
</div>
<?php require_once('templates/footer.php');
?>