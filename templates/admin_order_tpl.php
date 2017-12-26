<?php require_once('templates/header.php');?>
<?php require_once('includes/admin_menu.php');?>
<link type="text/css" rel="stylesheet" href="css/admin_orders.css">
<script src='includes/js.js'></script>

    <!--ORDRAR--->

    <!-- SÖK FORMULÄR -->
  
    <div class="search_order_div">
        <h2 class="rubrik2">SÖK ORDER</h2>
        <form method="post" action="?action=searchOrder" id="search_order" name="search_order">
        <input type="search" name="order_search" placeholder="Sök order" id="input_search_order">
        <button type="submit" id="search_order_btn" name="search_order_btn">SÖK</button>
        </form>
    </div>
    <hr id="order-hr">

    <h1 class="rubrik1">ALLA ORDRAR</h1>
        <table class="orders_table">
            <?php if(!empty($pagecontent->orders)) :?> 
                    <tr>
                        <th>Datum</th>
                        <th>OrderNr</th>
                        <th>Person_id</th>
                        <th>Payement_id</th>
                        <th>Shipper_id</th>
                        <th>Status</th>
                        <th>Detaljer</th>
                    </tr>                         
                <?php foreach ($pagecontent->orders as $currorder): ?> 
                    <tr>
                        <td><?php echo substr($currorder['Datum'], 0, -9);?> </td>
                        <td><?php echo $currorder['OrderNr'];?> </td>
                        <td><?php echo $currorder['Person_id'];?></td>
                        <td><?php echo $currorder['Payement_id'];?></td>
                        <td><?php echo $currorder['Shipper_id'];?></td>
                        <td>
                            <form method ="post" action="?action=updateOrderStatus&oid=<?php echo $currorder['OrderNr'];?>">      
                                <select name="status[order]" id='selectStatus'>
                                <?php
                                foreach ($pagecontent->status as $currstatus) {

                                echo '<option value="'.$currstatus["status_id"].'"';
                                if ($currstatus["status_id"] == $currorder['Status']){
                                    echo ' selected';
                                }
                                echo '>'.$currstatus['title'].'</option>';
                                };?>
                                </select>
                                <button type="submit" id="updateStatus" name="updateStatus" class="foobar">Uppdatera</button>
                             </form>
                        </td>       
                        <td><a href="?action=singleOrder&oid=<?php echo $currorder['OrderNr'];?>" id="info-a">Orderinfo</a></td>
                    </tr>
                    <?php endforeach ?>

            <?php endif ?>
        </table>
<?php require_once('templates/footer.php');?>

