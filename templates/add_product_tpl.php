<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>
<link type="text/css" href="css/add_product.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<h1 id="add-product-h1">SKAPA NY PRODUKT</h1>
<hr>

<?php if ($pagecontent->error !== ""){
    echo '<p id="p-error">'.$pagecontent->error.'</p>';
} else if (!empty($last_id)) {
    echo '<p id="p-success">Produkt tillagd!</p>';
    echo '<h2>Produktens id är: '.$last_id.'</h2>';
}?>

<form method="post" action="?action=create-product" enctype="multipart/form-data" id="create-product" name="add-product">
    <input type="file" name="file1" id="file-upload">
    <input type="text" name="product[title]" id="prod-title" placeholder="Produkttitel">
    <input type="text" name="product[price]" id="prod-price" placeholder="Pris">
    <textarea form="create-product" rows="10" cols="50" name="product[desc]" id="prod-desc" placeholder="Produktbeskrivning"></textarea>
    <p>Ange kategori:</p>
    <select name="product[cat_id]">
        <?php foreach ($pagecontent->category as $currcat) {
            echo '<option value="'.$currcat["cat_id"].'">'.$currcat['title'].'</option>';
        }?>
    </select>
    <p>Ange status:</p>
    <select name="product[status]">
        <option value="active" name="product[active]">Aktiv</option>
        <option value="inactive" name="product[inactive]">Inaktiv</option>
    </select>
    <!-- FORM TOKEN-->
    <?php echo getTokenField(); ?>
    
    <button type="submit" id="save-product-button" name ="save-product">Spara produkt</button>
    
</form>

<?php require_once('templates/footer.php');?>
