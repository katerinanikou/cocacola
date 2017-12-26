<?php
    include('templates/header.php');
?>
<link rel="stylesheet" type="text/css" href="css/customer_profile.css">
<div class="confirm_deleteForm">
    <form action="" method="post">
        <h1 class="Confirm-delete">Vill du verkligen radera ditt konto hos Millhouse?</h1>
        
        <!--När radera knapp trycks anropas action delete_profile och denactuella user Id skickas -->
        <div class="buttons">
        <input type="submit" class="btn btn-danger" value="Ja, radera" name="delete" action="?action=delete_permanent_profile&uid=<?php $accountToDelete;?>">
        <input type="submit"  class ="btn btn-succes" value="Avbryt" name="cancel">
        </div>
    </form>
</div>
<?php require_once('templates/footer.php');?>

