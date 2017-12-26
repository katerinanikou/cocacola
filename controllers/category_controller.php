<?php 
$pagecontent = new stdClass;
include('meny_controller.php');

if (isset($_GET['id'])) {
	// SQL för att hämta produkter från en kategori
	$sql = "SELECT DISTINCT category.category_id, category.img_url as cat_img, 
			category.description as cat_desc, 
			category.title as cat_title, 
			product.product_id, product.title, product.price, product_img.img_url as pdtImg
			
			FROM product, category, product_img
			WHERE product.category_id = category.category_id
			AND product.product_id = product_img.product_id
            AND product.inactive = 0 
			AND category.category_id= :id;";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":id", $_GET['id']);
	$stmt->execute();

} else {
    
	// SQL för att hämta alla produkter
	$sql = "SELECT * FROM product";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
}

$theLastProduct = null;

while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$theLastProduct = $product;
//skapa $theLastProduct för att kunna spara informationen från senaste hämtade raden.
		$currprod = array();
		$currprod['title'] = $product['title'];
		$currprod['product_id'] = $product['product_id'];
		$currprod['price'] = $product['price'];
		$currprod['img_url'] = $product['pdtImg'];
		$pagecontent->products[] = $currprod;    
    }       

        $pagecontent->category['product_id'] = $theLastProduct['product_id'];
		$pagecontent->category['img'] = $theLastProduct['cat_img'];
		$pagecontent->category['desc'] = $theLastProduct['cat_desc'];
		$pagecontent->category['title'] = $theLastProduct['cat_title'];
		//spara $product i $theLastProduct för att det skall finnas kvar när while loopen är körd och $product då blir false.


if (is_null($theLastProduct)) {
	$pagecontent->title = "Error";
	//om $theLastProduct är null = while loopen är false, dvs hittar inga produkter.
} else {
	$pagecontent->title = $pagecontent->category['title'];
}


require ("templates/category_tpl.php");