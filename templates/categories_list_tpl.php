<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>
<link type="text/css" href="css/cat_list.css" rel="stylesheet"> 

<h1 id="h1-cat"><?php echo strtoupper($pagecontent->title); ?></h1>
<hr>

<div id="cat-list-wrapper">

<!-- PRINTA ALLA KATEGORIER SOM FINNS I DATABASEN-->
      
<table class="list-wrapper">
  <tr>
    <th>Id</th>
    <th>Bild</th>
    <th>Titel</th>
    <th>Beskrivning</th>
    <th>Status</th>
    <th>Redigera</th>
  </tr>
    <?php foreach ($pagecontent->categories as $currcat) {
  echo '<tr>';
    printf ('<td>%s</td>',$currcat['category_id']);
    printf ('<td><img src="%s" class="cat-list-img"</td>',$currcat['img_url']);
    printf ('<td>%s</td>',$currcat['title']);
    printf ('<td class="cat-desc-list">%s</td>',$currcat['description']);
    echo '<td>'; 
    if ($currcat['status'] === '1'){
        echo 'Inaktiv';
    } else {
        echo 'Aktiv';
    }; 
    echo '</td>';
    echo '<td><a href="?action=edit-category&id='.$currcat['category_id'].'">Redigera</a></td>';
  echo '</tr>';
}?>
</table>
    
</div>
<?php require_once('templates/footer.php');?>
