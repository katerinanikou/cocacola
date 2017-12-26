<?php
$pagecontent = new stdClass;
$pagecontent->title = "Redigera kategori";

    $pagecontent->category_id = "";
    $pagecontent->cat_title = "";
    $pagecontent->description = "";
    $pagecontent->img_url = "";
    $pagecontent->error = "";

include('meny_controller.php');
include('includes/token.php');

getToken();

if (isset($_POST['cat-search']) || isset($_GET['id'])){
    
/****************** HÄR HÄMTAS SÖKRESULTATET ******************/

$sql = "SELECT * FROM category WHERE category_id = :cat_id";
	$stmt = $pdo->prepare($sql);
    
        
    if (isset($_POST['cat-search'])){
    $id = $_POST['cat-search'];
    }
    
    if (isset($_GET['id'])){
        $id = $_GET['id'];
    }
    
    
    $stmt->bindParam(':cat_id', $id);
	$stmt->execute();
    $result = $stmt->fetch();

if (count($result)> 1){
    $pagecontent->category_id = $id;
    $pagecontent->cat_title = $result['title'];
    $pagecontent->description = $result['description'];
    $pagecontent->img_url = $result['img_url'];
    } else {
    $pagecontent->error = "Kategorin finns inte!";
}
}


require('templates/edit_cat_tpl.php');
?>