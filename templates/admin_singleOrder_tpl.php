<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>
<link type="text/css" rel="stylesheet" href="css/admin_orders.css">

    <h2 id="singelOrderRubrik">Detaljer för order nr <?php echo $_GET['oid'];?> </h2>
                <table class="orders_table">
                    <?php if(!empty($pagecontent->orderItems)) :?> 
                            <tr>
                                <th>Produkt_id</th>
                                <th>Pris</th>
                                <th>Antal</th>
                                <th>Total</th>
                            </tr>                         
                        <?php foreach ($pagecontent->orderItems as $orderItemRow): ?> 
                            <tr>
                                <td><?php echo $orderItemRow['Produkt_id'];?></td>
                                <td><?php echo $orderItemRow['Pris'];?></td>
                                <td><?php echo $orderItemRow['Antal'];?> </td></a>
                                <td><?php echo $orderItemRow['Total'];?> </td></a>
                            </tr>
                        <?php endforeach ?>
                        
                    <?php endif ?>
                </table>
<div class="totalSumma"> 
    <label id="label1"> Totalsumma </label>
    <label id="label2"> <?php echo $totalsumma ?> KR</label>
</div>
<!--
<select name="order[status]">
// var dump post array ska heta order[status]--1 2 3
om post oreder status = 1 sätt 1 i databasen
        <option value="1" name="order[1]">Mottagen</option>
        <option value="2" name="order[2]">Skickad</option>
        <option value="3" name="order[3]">Makulerad</option>
 </select>
$_post['order']['status']=== '1'{}.

--!>

<?php require_once('templates/footer.php');?>