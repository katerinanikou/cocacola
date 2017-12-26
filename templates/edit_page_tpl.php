<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>
<link type="text/css" href="css/add_product.css" rel="stylesheet"> 
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<h1 id="edit-page-h1"><?php echo strtoupper($pagecontent->title); ?></h1>
<?php if ($pagecontent->error !== ""){
    echo '<p id="p-error">'.$pagecontent->error.'</p>';
} else if (isset($_GET['id']) && $pagecontent->error === "") {
    echo '<p id="p-success">Ändringar sparade!</p>';
}?>


<!-- VÄLJ SIDA ATT REDIGERA -->
<form method="post" action="?action=update-page" id="search-page" name="search-page">
<p>Välj sida att redigera:</p>
<select name="pages[pages_id]">
      <?php foreach ($pagecontent->pages as $currpage) {
        echo '<option name="page" value="'.$currpage["pages_id"].'">'.$currpage['title'].'</option>';
        }?>
    </select>
<button type="submit" id="search-page-button" name="edit-button">REDIGERA</button>
</form>

<hr>

<!-- REDIGERA FORMULÄR -->
<form method="post" action="?action=update-page&id=<?php echo $pagecontent->id?>" enctype="multipart/form-data" id="update-page" name="edit-page">
    <div id="prod-pic-div">
        <img src="<?php echo $pagecontent->img_url;?>" id="prod-pic">
    </div>
    <input type="file" name="file1" id="file-upload">
    <input type="hidden" name="saved-img" value="<?php echo $pagecontent->img_url;?>">
    <input type="text" name="page[title]" id="page-title" placeholder="Titel" value="<?php echo $pagecontent->title1; ?>">
    <textarea form="update-page" rows="10" cols="50" name="page[content1]" id="page-desc1" placeholder="Textfält1"><?php echo $pagecontent->content1; ?></textarea>
    <textarea form="update-page" rows="10" cols="50" name="page[content2]" id="page-desc2" placeholder="Textfält2"><?php echo $pagecontent->content2;?></textarea>

      <!-- FORM TOKEN-->
    <?php echo getTokenField(); ?>
    
    
    <button type="submit" id="save-page-button" name="save-page">Spara</button>

    
</form>

<?php require_once('templates/footer.php');?>