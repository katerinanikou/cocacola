<?php
$pagecontent = new stdClass;
$pagecontent->title = 'Användare';
include('meny_controller.php');

$sql = "SELECT * FROM person";

        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute();
        $result = $stmt->fetchAll();

        
    echo "<table class='user_list'>";
    echo "<thead>;";
    echo "<tr class='user_list_row'>";
    echo "<th>Användarid</th>";
    echo "<th>Förnamn</th>";
    echo "<th>Efternamn</th>";
    echo "<th>Email</th>";
    echo "<th>Adress 1</th>";
    echo "<th>Adress 2</th>";
    echo "<th>Postnummer</th>";
    echo "<th>Stad</th>";
    echo "<th>Telefon</th>";
    echo "<th>Nyhetsbrev</th>";
    echo "<th>Skapad</th>";
    echo "<th>Uppdaterad</th>";
    echo "<th>Behörighet</th>";
    echo "<th>Redigera</th>";
    echo "</tr>";
    echo "</thead>";
    
    if (count($result)> 1){
        require('templates/header.php');
        require_once('includes/admin_menu.php');
      echo $pagecontent->title = "<h2 class='user_list_header'>LISTA PÅ ANVÄNDARE</h2>";
      echo '<a class="admin_link" href="?action=login">TILLBAKA TILL START ADMIN</a>';
        

        foreach($result as $user) {
      
      $pagecontent->fname = $user["fname"];
      $pagecontent->lname = $user["lname"];
      $pagecontent->email = $user["email"];
      $pagecontent->street1 = $user["street1"];
      $pagecontent->street2 = $user["street2"];
      $pagecontent->zip = $user["zip"];
      $pagecontent->city = $user["city"];
      $pagecontent->phone= $user["phone"];
      $pagecontent->newletter= $user["newletter"];
      $pagecontent->created_at= $user["created_at"];
      $pagecontent->updated_at= $user["updated_at"];
      $pagecontent->level= $user["level"];
      $pagecontent->uid = $user["person_id"];


require('templates/parts/user_list_tpl.php');

    }
    
    echo "</table>";
    require('templates/footer.php');

}
