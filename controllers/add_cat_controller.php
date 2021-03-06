<?php
$pagecontent = new stdClass;
$pagecontent->title = "Skapa kategori";
$pagecontent->error = "";
require('handle_cat_controller.php');
include('meny_controller.php');
include('includes/token.php');

getToken();
/***** HÄMTAR KATEGORITITEL OCH ID TILL RULLISTAN *****/

$sql = "SELECT title, category_id FROM category;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
    $result = $stmt->fetchAll();

$pagecontent->category = array();

foreach ($result as $category) {
	$currcat = array();
	$currcat['title'] = $category['title'];
	$currcat['cat_id'] = $category['category_id'];
	$pagecontent->category[] = $currcat;
}

require('templates/add_category_tpl.php');
?>