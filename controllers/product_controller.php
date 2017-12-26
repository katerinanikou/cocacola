<?php
$pagecontent = new stdClass;
include('meny_controller.php');
include('includes/token.php');

$sql = "SELECT * FROM granza.product, granza.product_img
        WHERE granza.product.product_id = granza.product_img.product_id
        AND granza.product.inactive = 0 
        AND granza.product.product_id = :id;";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':id', $_GET['pid']);
$stmt->execute();

$result = $stmt->fetch();


if (count($result) < 1){
    $pagecontent->title = 'Ingen produkt hittades';
} else {
    $pagecontent->cat_id = $result['category_id'];
    $pagecontent->pid = $result['product_id'];
    $pagecontent->title = $result['title'];
    $pagecontent->description = $result['description'];
    $pagecontent->price = $result['price'];
    $pagecontent->img_url = $result['img_url'];
}


/************** HÄMTAR LIKNANDE PRODUKTER**********/

$pagecontent2 = new stdClass;

if($pagecontent->cat_id === "1"){
        $sql2 = "SELECT * FROM granza.product, granza.product_img WHERE 
        granza.product.product_id = granza.product_img.product_id
        AND granza.product.category_id = 1 
        AND granza.product.inactive = 0 ORDER BY rand() LIMIT 4";
} else if ($pagecontent->cat_id === "2"){
         $sql2 = "SELECT * FROM granza.product, granza.product_img WHERE 
        granza.product.product_id = granza.product_img.product_id
        AND granza.product.category_id = 2 
        AND granza.product.inactive = 0 ORDER BY rand() LIMIT 4";
} else if ($pagecontent->cat_id === "3"){
        $sql2 = "SELECT * FROM granza.product, granza.product_img WHERE 
        granza.product.product_id = granza.product_img.product_id
        AND granza.product.category_id = 3 
        AND granza.product.inactive = 0 ORDER BY rand() LIMIT 4";
}
	$stmt = $pdo->prepare($sql2);
	$stmt->execute();

$theLastProduct = null;

while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$theLastProduct2 = $product;
		$currprod = array();
		$currprod['title_2'] = $product['title'];
		$currprod['product_id_2'] = $product['product_id'];
		$currprod['price_2'] = $product['price'];
		$currprod['img_url_2'] = $product['img_url'];
		$pagecontent2->products[] = $currprod;
	}
       
        $pagecontent2->similar['product_id_2'] = $theLastProduct['product_id_2'];
		$pagecontent2->similar['img_url_2'] = $theLastProduct['start_img_2'];
		$pagecontent2->similar['price_2'] = $theLastProduct['start_price_2'];
		$pagecontent2->similar['title_2'] = $theLastProduct['start_title_2'];

if (is_null($theLastProduct)) {
	$pagecontent2->title = "Error";
} else {
	$pagecontent2->title = "";
}

require('templates/product_tpl.php');
