<?php
$pagecontent = new stdClass;
include('meny_controller.php');
$pagecontent->title = "startpagecontrollerna körs";

/**************** HÄMTAR ERBJUDANDE ***************/

$sql = "SELECT * FROM granza.pages WHERE pages_id = 2";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$result = $stmt->fetch();


if (count($result) < 1){
    $pagecontent->title = 'Inget hittades';
} else {
    
    $pagecontent->offer_title = $result['title'];
    $pagecontent->content1 = $result['content1'];
    $pagecontent->content2 = $result['content2'];
    $pagecontent->offer_img_url = $result['head_img_url'];
}

/**************** HÄMTAR 4 KLOCKOR ***************/
$sql = "SELECT * FROM granza.product, granza.product_img WHERE 
        product.product_id = product_img.product_id
        AND product.category_id = 1
        AND product.inactive = 0 ORDER BY rand() LIMIT 4";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

$theLastProduct = null;

while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$theLastProduct = $product;
		$currprod = array();
		$currprod['title'] = $product['title'];
		$currprod['product_id'] = $product['product_id'];
		$currprod['price'] = $product['price'];
		$currprod['img_url'] = $product['img_url'];
		$pagecontent->products[] = $currprod;
	}
       
        $pagecontent->start['product_id'] = $theLastProduct['product_id'];
		$pagecontent->start['img_url'] = $theLastProduct['img_url'];
		$pagecontent->start['price'] = $theLastProduct['price'];
		$pagecontent->start['title'] = $theLastProduct['title'];


if (is_null($theLastProduct)) {
	$pagecontent->title = "Error";
} else {
	$pagecontent->title = "Startsida";
}

/**************** HÄMTAR 4 SOLGLASÖGON ***************/
$sql2 = "SELECT * FROM granza.product, granza.product_img WHERE 
        product.product_id = product_img.product_id
        AND product.category_id = 2
        AND product.inactive = 0 ORDER BY rand() LIMIT 4";
	$stmt = $pdo->prepare($sql2);
	$stmt->execute();

$theLastProduct2 = null;

while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$theLastProduct2 = $product;
		$currprod2 = array();
		$currprod2['title_2'] = $product['title'];
		$currprod2['product_id_2'] = $product['product_id'];
		$currprod2['price_2'] = $product['price'];
		$currprod2['img_url_2'] = $product['img_url'];
		$pagecontent2->products[] = $currprod2;
	}

        $pagecontent2->start['product_id_2'] = $theLastProduct2['product_id'];
		$pagecontent2->start['img_url_2'] = $theLastProduct2['img_url'];
		$pagecontent2->start['price_2'] = $theLastProduct2['price'];
		$pagecontent2->start['title_2'] = $theLastProduct2['title'];



/**************** HÄMTAR 4 DOFTLJUS ***************/
$sql3 = "SELECT * FROM granza.product, granza.product_img WHERE 
        product.product_id = product_img.product_id
        AND product.category_id = 3
        AND product.inactive = 0 ORDER BY rand() LIMIT 4";
	$stmt = $pdo->prepare($sql3);
	$stmt->execute();


$theLastProduct3 = null;

while ($product = $stmt->fetch(PDO::FETCH_ASSOC) ) {
		$theLastProduct3 = $product;
		$currprod3 = array();
		$currprod3['title_3'] = $product['title'];
		$currprod3['product_id_3'] = $product['product_id'];
		$currprod3['price_3'] = $product['price'];
		$currprod3['img_url_3'] = $product['img_url'];
		$pagecontent3->products[] = $currprod3;
	}
       
        $pagecontent3->start['product_id_3'] = $theLastProduct2['product_id'];
		$pagecontent3->start['img_url_3'] = $theLastProduct2['img_url'];
		$pagecontent3->start['price_3'] = $theLastProduct2['price'];
		$pagecontent3->start['title_3'] = $theLastProduct2['title'];

require('templates/startpage_tpl.php');