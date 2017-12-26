<?php
include('meny_controller.php');

$pagecontent = new stdClass;


$sql = "SELECT * FROM product, product_img
        WHERE product.product_id = product_img.product_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$theLastProduct = null;

while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$theLastProduct = $product;
		$currprod = array();
		$currprod['title'] = $product['title'];
		$currprod['product_id'] = $product['product_id'];
		$currprod['price'] = $product['price'];
		$currprod['img_url'] = $product['img_url'];
        $currprod['description'] = $product['description'];
        $currprod['category_id'] = $product['category_id'];
        $currprod['status'] = $product['Inactive'];
		$pagecontent->products[] = $currprod; 
    
    }       

        $pagecontent->product['product_id'] = $theLastProduct['product_id'];
		$pagecontent->product['img_url'] = $theLastProduct['img_url'];
		$pagecontent->product['description'] = $theLastProduct['description'];
		$pagecontent->product['title'] = $theLastProduct['title'];
        $pagecontent->product['price'] = $theLastProduct['price'];
        $pagecontent->product['category_id'] = $theLastProduct['category_id'];
		$pagecontent->product['status'] = $theLastProduct['Inactive'];



if (is_null($theLastProduct)) {
	$pagecontent->title = "Inga produkter hittades";
} else {
	$pagecontent->title = $pagecontent->title = "Produkter";
}

include('templates/product_list_tpl.php');