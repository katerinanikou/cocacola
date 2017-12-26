<?php

include('meny_controller.php');
include('includes/token.php');

$pagecontent = new stdClass;
$pagecontent->title = "Redigera kategori";
$pagecontent->category_id = "";
$pagecontent->cat_title = "";
$pagecontent->description = "";
$pagecontent->img_url = "";
$pagecontent->error = "";

/************** UPPDATERAR DB MED KATEGORIINFO  ****************/
/*******VARIABLER SOM ANVÄNDS FLERA GÅNGER**********/

        $cat_id = $_GET['id'];
        $cat_title = $_POST['cat']['title'];
        $cat_desc = $_POST['cat']['desc'];

    if (array_key_exists('save-cat', $_POST)){
        
        
        $sql = "UPDATE granza.category 
        SET category.title = :title, category.description = :description WHERE category.category_id = :id";
    
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':id', $cat_id);
        $stmt->bindParam(':title', $cat_title);
        $stmt->bindParam(':description', $cat_desc);
    
        if (checkToken($_POST['token'])) {
            
        $stmt->execute();
        
        if ($_POST['cat']['status'] === 'active'){
            $sql = "UPDATE granza.category SET category.Inactive = 0 WHERE category.category_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $cat_id); 
            $stmt->execute();
        }
    
        if ($_POST['cat']['status'] === 'inactive'){
    
           $sql = "UPDATE granza.category SET category.Inactive = 1 WHERE category.category_id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $cat_id);
            $stmt->execute();

    
    }
}
}


$upload_dir = 'uploads/category';

/****************** OM INGEN NY BILDFIL LADDAS UPP ******************/

if($_FILES['file1']['name'] === ""){

$sql2 = "UPDATE granza.category SET img_url = :img_url WHERE category_id = :id";
    
    $saved_img = $_POST['saved-img'];

    $stmt = $pdo->prepare($sql2);
    $stmt->bindParam(':img_url', $saved_img);
    $stmt->bindParam(':id', $cat_id);   
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
    // här flyttar vi filen till den valda mappen eller det valda stället i filstrukturen.
        move_uploaded_file($_FILES['file1']['tmp_name'], $url);
        
           $sql3 = "UPDATE granza.category SET img_url = :img_url WHERE category_id = :id";
        
        $cat_id = $_GET['id'];

            $stmt = $pdo->prepare($sql3);
            $stmt->bindParam(':img_url', $url);
            $stmt->bindParam(':id', $cat_id);   
            $stmt->execute(); 
        
    } else {
        $pagecontent->error = 'Något blev fel: <br>'.$message;
    }
}
require('templates/edit_cat_tpl.php');