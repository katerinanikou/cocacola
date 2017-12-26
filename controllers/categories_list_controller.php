<?php

include('meny_controller.php');

$pagecontent = new stdClass;
$pagecontent->title = "Kategorier";


$sql = "SELECT * FROM category";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$theLastCategory = null;

while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
		$theLastCategory = $category;
		$currcat = array();
		$currcat['title'] = $category['title'];
		$currcat['category_id'] = $category['category_id'];
		$currcat['description'] = $category['description'];
		$currcat['img_url'] = $category['img_url'];
        $currcat['status'] = $category['Inactive'];
		$pagecontent->categories[] = $currcat;    
    }       

        $pagecontent->category['category_id'] = $theLastCategory['category_id'];
		$pagecontent->category['img_url'] = $theLastCategory['img_url'];
		$pagecontent->category['description'] = $theLastCategory['description'];
		$pagecontent->category['title'] = $theLastCategory['title'];
        $pagecontent->category['status'] = $theLastCategory['Inactive'];



include('templates/categories_list_tpl.php');
