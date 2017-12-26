<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>
<link type="text/css" href="css/add_category.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1">  

<h1 id="add-cat-h1"><?php echo strtoupper($pagecontent->title); ?></h1>
<hr>
    <?php
if ($pagecontent->error !== ""){
    echo '<p id="p-error">'.$pagecontent->error.'</p>';
}else if (!empty($last_id)) {
        echo '<p id="p-success">Kategori tillagd!</p>';
        echo '<h2>Kategorins id är: '.$last_id.'</h2>';
    }
?>

<form method="post" action="?action=create-category" enctype="multipart/form-data" id="create-cat" name="add-category">
    <input type="file" name="file1" id="file-upload-cat">
    <input type="text" name="cat[title]" id="cat-title" placeholder="Kategorititel">
    <textarea form="create-cat" rows="4" cols="50" name="cat[desc]" id="cat-desc" placeholder="Kategoribeskrivning"></textarea>
    <p>Ange status:</p>
    <select name="cat[status]">
        <option value="active" name="cat[active]">Aktiv</option>
        <option value="inactive" name="cat[inactive]">Inaktiv</option>
    </select>

    <!-- FORM TOKEN-->
    <?php echo getTokenField(); ?>
    
    <button type="submit" id="save-cat-button">Spara kategori</button>
</form>
<?php require_once('templates/footer.php');?>