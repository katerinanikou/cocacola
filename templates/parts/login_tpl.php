<link type="text/css" rel="stylesheet" href="css/login.css">

<?php
include('templates/header.php');
?>

<div class="main_wrapper">
<div class="login">
        <!--INPUTFÄLT LOGGA IN-->
    <h2 class="login_title"><?php echo $pagecontent->h2 ?></h2>
    <form action="" method="post" autocomplete="off" name="login">
        <input class="login" type="text" name="email" placeholder="E-postadress">
        <br>
        <input class="login" id="passinput" type="password" name="input_password" placeholder="Lösenord">
        <br>
        
        <!-- FORM TOKEN-->
        <?php echo getTokenField(); ?>

        <!-- LOGGA IN-KNAPP-->
        <button type="submit" id="login">LOGGA IN</button>
      

        <div class="login_wrapper">
            <label id="remember_me" for="checkbox">Kom ihåg mig</label>
            <input type="checkbox" name="remember_me" id="checkbox">
            <a href="?action=forgot_password" id="forgot-password">Glömt lösenord?</a>
        </div>
    </form>
</div>

<div class="create_account">
        <!--INPUTFÄLT LOGGA IN-->
    <h2 class="create_title">BLI MEDLEM HOS MILLHOUSE</h2>
    <form class="create_account" action="?action=create_user" method="post" autocomplete="off">
        

        <!-- LOGGA IN-KNAPP-->
        <button type="submit" id="send" name="submit_button">SKAPA KONTO</button>
        <br>
    </form>
</div>
</div>

<?php
include('templates/footer.php');
?>