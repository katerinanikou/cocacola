<?php
include('meny_controller.php');
include('includes/token.php');

$pagecontent = new stdClass;
$pagecontent->title = "Redigera Sida";
$pagecontent->error = "";

//********* HÄMTA UT DEN VALDA SIDAN *********/

if (array_key_exists('edit-button', $_POST)){

$sql = "SELECT * FROM granza.pages WHERE pages_id = :id";
$stmt = $pdo->prepare($sql);
    
$id = $_POST['pages']['pages_id'];
    
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetch();

if (count($result) > 1) {
    $pagecontent->id = $result['pages_id'];
    $pagecontent->title1 = $result['title'];
    $pagecontent->content1 = $result['content1'];
    $pagecontent->content2 = $result['content2'];
    $pagecontent->img_url = $result['head_img_url'];
}
}

//********* UPPDATERAR I DB *********/

if (array_key_exists('save-page', $_POST)){
    
    
    $pagecontent->title1 = "";
    $pagecontent->content1 = "";
    $pagecontent->content2 = "";
    $pagecontent->img_url = "";
    
    
    $sql = "UPDATE granza.pages SET title = :title, content1 = :content1, content2 = :content2 WHERE pages_id = :id";
    $stmt = $pdo->prepare($sql);
    
    $id = $_GET['id'];
    $title = $_POST['page']['title'];
    $content1 = $_POST['page']['content1'];
    $content2 = $_POST['page']['content2'];
    
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':content1', $content1);
    $stmt->bindParam(':content2', $content2);
    
    if (checkToken($_POST['token'])) { 

    $stmt->execute();
    

}

//********* OM INGEN NY BILD LADDAS UPP *********/

if (isset($_GET['id'])){
$pages_id = $_GET['id'];

if($_FILES['file1']['name'] === ""){

$sql2 = "UPDATE granza.pages SET head_img_url = :img_url WHERE pages_id = :id";
    
    $saved_img = $_POST['saved-img'];

    $stmt = $pdo->prepare($sql2);
    $stmt->bindParam(':img_url', $saved_img);
    $stmt->bindParam(':id', $pages_id);   
    $stmt->execute(); 
    
} 


/****************** LADDA UPP NY BILD ******************/

else if (strlen($_FILES['file1']['name']) > 1 ){ 
$upload_dir = 'uploads/pages';
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
        
          $sql3 = "UPDATE granza.pages SET head_img_url = :img_url WHERE pages_id = :id";

            $stmt = $pdo->prepare($sql3);
            $stmt->bindParam(':img_url', $url);
            $stmt->bindParam(':id', $pages_id);   
            $stmt->execute(); 
        
    } else {
        $pagecontent->error = 'Något blev fel: <br>'.$message;
    }
}
}
}


require('templates/edit_page_tpl.php');