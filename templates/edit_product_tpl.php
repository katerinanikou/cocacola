<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>    

<link type="text/css" href="css/add_product.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 


<h1 id="add-product-h1"><?php echo strtoupper($pagecontent->title); ?></h1>
<hr>
<?php 
if (isset($_GET['pid']) && $pagecontent->error !== ""){
    echo '<p id="p-error">'.$pagecontent->error.'</p>';
} else if (isset($_POST['save-product']) && $pagecontent->error === "") {
    echo '<p id="p-success">Ändringar sparade!</p>';
}?>


<!-- SÖK FORMULÄR -->
<form method="post" action="?action=edit-product" id="search-product" name="search-product">
<input type="search" name="prod-search" placeholder="Sök produkt">
<button type="submit" id="search-product-button">SÖK</button>
</form>

<hr>

<!-- REDIGERA FORMULÄR -->
<form method="post" action="?action=update-product&pid=<?php echo $pagecontent->pid?>" enctype="multipart/form-data" id="update-product" name="edit-product">
    <div id="prod-pic-div">
        <img src="<?php echo $pagecontent->img_url;?>" id="prod-pic">
    </div>
    <input type="file" name="file1" id="file-upload">
    <input type="hidden" name="saved-img" value="<?php echo $pagecontent->img_url;?>">
    <input type="text" name="product[title]" id="prod-title" placeholder="Produkttitel" value="<?php echo $pagecontent->prod_title;?>">
    <input type="text" name="product[price]" id="prod-price" placeholder="Pris" value="<?php echo $pagecontent->price;?>">
    <textarea form="update-product" rows="10" cols="50" name="product[desc]" id="prod-desc" placeholder="Produktbeskrivning"><?php echo $pagecontent->description;?></textarea>
    <p>Ange kategori:</p>
    <select name="product[cat_id]">
        <?php foreach ($pagecontent->category as $currcat) {
        echo '<option value="'.$currcat["cat_id"].'"';
        if ($currcat["cat_id"] == $pagecontent->category_id){
            echo ' selected';
        }
    echo '>'.$currcat['title'].'</option>';
};?>
    </select>
    <p>Ange status:</p>
    <select name="product[status]">
        <option value="active" name="product[active]">Aktiv</option>
        <option value="inactive" name="product[inactive]">Inaktiv</option>
    </select>
    
    <!-- FORM TOKEN-->
    <?php echo getTokenField(); ?>
    
    <button type="submit" id="save-product-button" name="save-product">Spara produkt</button>
    
</form>

<?php require_once('templates/footer.php');
?>
