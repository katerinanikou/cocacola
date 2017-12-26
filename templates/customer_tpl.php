<?php require_once('templates/header.php');
  //require('classes/Customer_class.php');
?>
<link type="text/css" rel="stylesheet" href="css/customer_profile.css">
<!--INLOGGAD MEMBER--->
<div class="my_profile_member">
    
    <!--SIDEBAR MENU--->
    <aside>
        <span></span> <!--::before element = profil_icon--->
        <h3>MIN PROFIL</h3>
        <ul>
            <li><a href="?action=password"><button type="button" class="change_password">ÄNDRA LÖSENORD</button></li>
            <li><a href="?action=logout"><button type="button" class="logout">LOGGA UT</button></a></li>          
            <li><a href="?action=delete_profile&uid=<?php $accountToDelete;?>"><button type="button" class="delete_profile">RADERA KONTO</button></a></li>
        </ul>
    </aside>
   
    <main>
        <!--VÄLKOMMEN--->
       <h1><?php echo "Välkommen ".$result['fname'];?></h1>
       
        <!--MINA SENASTE ORDRAR--->
        <fieldset>
            <legend>MINA SENASTE ORDRAR</legend>
                <table class="orders_table">
                    <?php if(!empty($pagecontent->orders)) :?> 
                            <tr>
                                <th>Datum</th>
                                <th>OrderNr</th>
                                <th>Summa</th>
                                <th>Status</th>
                                <th>Visa</th>
                            </tr>                         
                        <?php foreach ($pagecontent->orders as $currorder): ?> 
                            <tr>
                                <td><?php echo substr($currorder['datum'], 0, -9);?> </td>
                                <td><?php echo $currorder['order_id'];?> </td>
                                <td><?php echo $currorder['summa'].' KR';?></td>
                                <td><?php echo $currorder['status'];?> </td>
                                <td><a href="#">Visa</a></td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </table>
        </fieldset>

        <!--MINA UPPGIFTER--->
        <form action="?action=saveProfileChanges" method="post" class="myForm">
            <fieldset>
                <legend>MINA UPPGIFTER</legend>
                <input type="text" placeholder="Förnamn" name="fname" value="<?php echo $result['fname'];?>">
                <input type="text" placeholder="Efternamn" name="lname" value="<?php echo $result['lname'];?>">
                <input type="text" placeholder="Adress" name="adress1" value="<?php echo $result['street1'];?>">
                <input type="text" placeholder="Adress" name="adress2" value="<?php echo $result['street2'];?>">
                <input type="text" placeholder="Postnummer" name="zipcode" value="<?php echo $result['zip'];?>">
                <input type="text" placeholder="Stad" name="city" value="<?php echo $result['city'];?>">
                <input type="text" placeholder="Telefon" name="tel" value="<?php echo $result['phone'];?>">
                <input type="text" placeholder="Email" name="email" value="<?php echo $result['email'];?>">
                <div id="save_changes" ><button type="submit">SPARA ÄNDRINGAR</button></div>
            </fieldset>
        </form>
    </main>
    <div class="fix"></div>
</div>
<?php require_once('templates/footer.php');?>
    

