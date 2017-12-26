<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>

<link type="text/css" href="css/cat_list.css" rel="stylesheet"> 

<h1 id="h1-cat"><?php echo strtoupper($pagecontent->title); ?></h1>
<hr>

<div id="cat-list-wrapper">

<!-- PRINTA ALLA PRODUKTER SOM FINNS I DATABASEN-->
      
<table class="list-wrapper">
    
  <tr>
    <th>Id</th>
    <th>Bild</th>
    <th>Titel</th>
    <th>Beskrivning</th>
    <th>Pris</th>
    <th>Kategori</th>
    <th>Status</th>
    <th>Redigera</th>
  </tr>
    
    <?php foreach ($pagecontent->products as $currprod) {
    echo '<tr>';
    printf ('<td>%s</td>',$currprod['product_id']);
    printf ('<td><img src="%s" class="cat-list-img"</td>',$currprod['img_url']);
    printf ('<td>%s</td>',$currprod['title']);
    printf ('<td class="cat-desc-list">%s</td>',$currprod['description']);
    printf ('<td>%s</td>',$currprod['price']);
    echo '<td>';
    if ($currprod['category_id'] === '1'){
        echo 'Klockor';
    } else if ($currprod['category_id'] === '2') {
        echo 'Solglasögon';
    } else if ($currprod['category_id'] === '3') {
        echo 'Doftljus';
    };
    echo '</td>';
    echo '<td>'; 
    if ($currprod['status'] === '1'){
        echo 'Inaktiv';
    } else {
        echo 'Aktiv';
    };
    echo '</td>';
    echo '<td><a href="?action=edit-product&pid='.$currprod['product_id'].'">Redigera</a></td>';
  echo '</tr>';
};?>
</table>
    
</div>


<?php require_once('templates/footer.php');?>