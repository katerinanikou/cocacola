<?php require_once('templates/header.php');?>
<!--KATEGORI SIDA-->
<link type="text/css" rel="stylesheet" href="css/category.css">

<div class="category">
    <!--KATEGORI BANNER-->
    <div class="category_banner">
       <img src="<?php echo $pagecontent->category['img']; ?>" class="cat_img">
    </div>
    
    <!--PRESENTATION AV KATEGORI-->
    <div class="category_banner_text">
        <h1><?php echo $pagecontent->category['title']; ?></h1>
        <p class="description"><?php echo $pagecontent->category['desc'];?></p>
    </div>
    <div class="main_wrapper">
    <!--PRODUKTER: GENERERAS SÅ MÅNGA SOM DATABASEN VISAR-->
    <?php 
    foreach ($pagecontent->products as $currprod) {
    echo '<div class="product_wrapper">';
    echo '<a href="?action=product&pid='.$currprod['product_id'].'">';
    echo '<img src="'.$currprod['img_url'].'" class="prod_img">';
    echo '<h3>'.$currprod['title'].'</h3>';
    echo '<p class ="price">'.$currprod['price'] .' KR'.'</p>';
    echo '<button id="button" type="button">KÖP</button>';
    echo '</a>';
    echo '</div>';
    } ?>
    </div>
</div>
<?php require_once('templates/footer.php');?>