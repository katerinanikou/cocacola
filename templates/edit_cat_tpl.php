<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>

<link type="text/css" href="css/add_category.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1">  

<h1 id="add-cat-h1"><?php echo strtoupper($pagecontent->title); ?></h1>
<hr>

<?php 
if ($pagecontent->error !== ""){
    echo '<p id="p-error">'.$pagecontent->error.'</p>';
} else if (isset($_POST['save-cat']) && $pagecontent->error === "") {
    echo '<p id="p-success">Ändringar sparade!</p>';
}?>

<form method="post" action="?action=edit-category" id="search-cat" name="search-category">
<input type="search" name="cat-search" placeholder="Sök Kategori">
<button type="submit" id="search-cat-button">SÖK</button>
</form>

<hr>

<form method="post" action="?action=update-category&id=<?php echo $pagecontent->category_id;?>" enctype="multipart/form-data" id="create-cat" name="edit-category">
      <div id="cat-pic-div">
        <img src="<?php echo $pagecontent->img_url;?>" id="cat-pic">
    </div>
    <input type="file" name="file1" id="file-upload-cat">
    <input type="hidden" name="saved-img" value="<?php echo $pagecontent->img_url;?>">
    <input type="text" name="cat[title]" id="cat-title" placeholder="Kategorititel" value="<?php echo $pagecontent->cat_title;?>">
    <textarea form="create-cat" rows="6" cols="50" name="cat[desc]" id="cat-desc" placeholder="Kategoribeskrivning"><?php echo $pagecontent->description;?></textarea>
    <p>Ange status:</p>
    <select name="cat[status]">
        <option value="active" name="cat[active]">Aktiv</option>
        <option value="inactive" name="cat[inactive]">Inaktiv</option>
    </select>
    
    <!-- FORM TOKEN-->
    <?php echo getTokenField(); ?>
    

    <button type="submit" id="save-cat-button" name="save-cat">Spara kategori</button>

</form>


<?php require_once('templates/footer.php');
?>