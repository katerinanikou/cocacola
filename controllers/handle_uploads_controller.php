<?php
$pagecontent = new stdClass;
$pagecontent->error = "";
$pagecontent->title = "Skapa produkt";
/****************** HÄR HÄMTAS FILEN SOM LADDAS UPP ******************/
// till denna mappen flyttas filerna
$upload_dir = 'uploads/product';

include('uploads_controller.php');

/****************** TRYCK IN DATAN I DB ******************/
if (isset($_POST['product']) !== NULL && (!empty($_FILES['file1']['size']))){

/** INSERT I DB *****/

$sql = "INSERT INTO product (category_id, title, description, price, Inactive) 
VALUES (:category_id, :title, :description, :price, :inactive)";

$stmt = $pdo->prepare($sql);
    
    if ($_POST['product']['status'] === 'inactive'){
        $status = '1';
    } else {
        $status = '0';
    }
    
$prod_cat = $_POST['product']['cat_id'];
$prod_title = $_POST['product']['title'];
$prod_desc = $_POST['product']['desc'];
$prod_price = $_POST['product']['price'];
$prod_status = $status;
    
$stmt->bindParam(':category_id', $prod_cat);
$stmt->bindParam(':title', $prod_title);
$stmt->bindParam(':description', $prod_desc);
$stmt->bindParam(':price', $prod_price);
$stmt->bindParam(':inactive', $prod_status);
    
/**** KOLLAR SÅ ATT TOKEN STÄMMER ****/
    if (checkToken($_POST['token'])) {    

        $stmt->execute();
        $last_id = $pdo->lastInsertId();

        /******** LÄGG TILL BILDEN I TABELLEN MED AKTUELLT PID *****/

        $sql2 = "INSERT INTO product_img (product_id, img_url) 
                VALUES (:product_id, :img_url)";  
        $stmt = $pdo->prepare($sql2);

        $stmt->bindParam(':product_id', $last_id);
        $stmt->bindParam(':img_url', $url);

        $stmt->execute();
    }      

}

    
