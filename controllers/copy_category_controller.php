<?php 
 echo "Running the kategori controller";
$pagecontent = new stdClass;



if (isset($_GET['id'])) {
	// SQL för att hämta produkter från en kategori
	$sql = "SELECT * FROM product, product_img
			WHERE product.product_id = product_img.product_img_id
			AND category_id = :id";

	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(":id", $_GET['id']);
	$stmt->execute();
	$result = $stmt->fetchAll();


//	var_dump($result);


} else {
	// SQL för att hämta alla produkter

	$sql = "SELECT * FROM product";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetchAll();
	
	//echo '<pre>';
	//var_dump($result);
	//echo '</pre>';
}

$pagecontent->products = array();

foreach ($result as $product) {
	$currprod = array();
	$currprod['title'] = $product['title'];
	$currprod['product_id'] = $product['product_id'];
	$currprod['price'] = $product['price'];
	$currprod['img_url'] = $product['img_url'];
	$pagecontent->products[] = $currprod;

}

if (count($result) < 1) {
	$pagecontent->title = "Inga produkter hittades";
} else {
	$pagecontent->title = "Visar alla produkter ";
}






require ("templates/category_tpl.php");