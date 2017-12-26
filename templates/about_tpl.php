<?php 
require_once('templates/header.php');
?>
<link type="text/css" rel="stylesheet" href="css/about_us.css">
<meta name="viewport" content="width=device-width, initial-scale=1"> 

<!--OM OSS-->
<div>
    <div id="about_us_banner">
        <img src="<?php echo $pagecontent->img_url; ?>"> 
    </div>
    <h1><?php echo $pagecontent->title; ?></h1>
    <p><?php echo $pagecontent->content1; ?></p>
    <h2><?php echo $pagecontent->content2; ?></h2>
</div>
<?php require_once('templates/footer.php');
?>