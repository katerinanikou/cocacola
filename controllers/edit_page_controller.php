<?php
include('meny_controller.php');
include('includes/token.php');

$pagecontent = new stdClass;
$pagecontent->title = "Redigera Sida";
$pagecontent->title1 = "";
$pagecontent->content1 = "";
$pagecontent->content2 = "";
$pagecontent->img_url = "";
$pagecontent->error = "";

getToken();

/******* HÄMTAR SIDOR TILL RULLISTAN I TPL *********/

$sql = "SELECT title, pages_id FROM granza.pages";
    $stmt = $pdo->prepare($sql);
	$stmt->execute();
    $result = $stmt->fetchAll();

$pagecontent->pages = array();
foreach ($result as $pages) {
	$currpage = array();
	$currpage['title'] = $pages['title'];
	$currpage['pages_id'] = $pages['pages_id'];
	$pagecontent->pages[] = $currpage;
}



include('templates/edit_page_tpl.php');
?>