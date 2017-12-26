<!--MENY-->
<div class="menu">
    <span></span> <!-- ::before fontello-icon X -->
    <h1>MENY</h1>
    
    <hr>

    <!--SÖK RUTA-->
    <input type="text" name="search">
    <button type="submit" name="submit_search">SÖK</button>
    
    <!--MENY ALTERNATIV-->
    
    <?php

$pagecontent = new stdClass;

/***** HÄMTAR KATEGORITITEL OCH ID *****/

$sql = "SELECT title, category_id FROM category;";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
    $result = $stmt->fetchAll();

$pagecontent->category = array();

foreach ($result as $category) {
	$currcat = array();
	$currcat['title'] = $category['title'];
	$currcat['cat_id'] = $category['category_id'];
	$pagecontent->category[] = $currcat;
}
    <p>SOLGLASÖGON</p>
    <hr>
    <p>KLOCKOR</p>
    <hr>
    <p>INREDNING</p>
    <hr>
    <p>OM OSS</p>
    <hr>
    <p>FAQ</p>

</div>

