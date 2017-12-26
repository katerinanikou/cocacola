<?php

include('meny_controller.php');
include('includes/token.php');
$pagecontent = new stdClass;
$pagecontent->title = "Redigera produkt";
$pagecontent->category_id = "";
$pagecontent->prod_title = "";
$pagecontent->price = "";
$pagecontent->description = "";
$pagecontent->img_url = "";
$pagecontent->error = "";

/************** UPPDATERAR DB MED PRODUKTINFO  ****************/

$pid = $_GET['pid'];

    if (array_key_exists('save-product', $_POST)){
        
        
        $sql = "UPDATE granza.product 
        SET product.title = :title, product.price = :price, product.description = :description, product.category_id = :category_id WHERE product.product_id = :id";
        
        $prod_title = $_POST['product']['title'];
        $prod_price = $_POST['product']['price'];
        $prod_desc = $_POST['product']['desc'];
        $prod_cat = $_POST['product']['cat_id'];
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $pid);
        $stmt->bindParam(':title', $prod_title);
        $stmt->bindParam(':price', $prod_price);
        $stmt->bindParam(':description', $prod_desc);
        $stmt->bindParam(':category_id', $prod_cat);
        
        if (checkToken($_POST['token'])) { 
        $stmt->execute();
        
        if ($_POST['product']['status'] === 'active'){
            $sql = "UPDATE granza.product SET product.Inactive = 0 WHERE product.product_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $pid);   
            $stmt->execute();
        }
    
        if ($_POST['product']['status'] === 'inactive'){
    
            $sql = "UPDATE granza.product SET product.Inactive = 1 WHERE product.product_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $pid);   
            $stmt->execute();

    
    }
}
}

$upload_dir = 'uploads/product';

/****************** OM INGEN NY BILDFIL LADDAS UPP ******************/

if($_FILES['file1']['name'] === ""){

$sql2 = "UPDATE granza.product_img SET img_url = :img_url WHERE product_id = :id";

            $stmt = $pdo->prepare($sql2);
            $stmt->bindParam(':img_url', $_POST['saved-img']);
            $stmt->bindParam(':id', $pid);   
            $stmt->execute(); 
} 

/****************** LADDA UPP NY BILD ******************/

else if (strlen($_FILES['file1']['name']) > 1 ){ 

    $error = false;
    
    if ($_FILES['file1']['size'] > 1024000){
        $error = true;
        $message = "Filen är för stor!";
    } elseif($_FILES['file1']['size'] < 1){
        $error = true;
        $message = "Ingen fil är vald!";
    } 
    
    $url = $upload_dir."/".$_FILES['file1']['name'];
    if (!$error){
        move_uploaded_file($_FILES['file1']['tmp_name'], $url);
        
           $sql3 = "UPDATE granza.product_img SET img_url = :img_url WHERE product_id = :id";

            $stmt = $pdo->prepare($sql3);
            $stmt->bindParam(':img_url', $url);
            $stmt->bindParam(':id', $pid);   
            $stmt->execute(); 
        
    } else {
       $pagecontent->error = 'Något blev fel: <br>'.$message;
    }   
}
require('templates/edit_product_tpl.php');