<?php require_once('templates/header.php');

?>
<!--LOGGA IN MED NYTT PASSWORD-->
	<link type="text/css" rel="stylesheet" href="css/forgot_password.css">
		<div class="forgot_pass">
			<h2 class="forgot_pass"><?php echo strtoupper($pagecontent->h2);?></h2>
				<form class="forgot_pass" action="?action=login" method="post" name="forgot-pass">
		    		<input class="login" type="text" name="email" placeholder="E-postadress">
		    		<button type="submit" id="forgot_button" name="forgot_button">SKICKA</button>
				</form>
		</div>

<?php require_once('templates/footer.php');
?>