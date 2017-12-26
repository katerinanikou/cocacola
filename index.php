<?php
// create session_start();
session_start();
//session_unset();
//session_destroy();


if (!isset($_SESSION['cart']))
  $_SESSION['cart'] = array();
/*
$token = uniqid("", true);
$_SESSION['token'] = $token;
*/
include('includes/validations.php');

// include settings
require_once('includes/settings.php');

// include dbcon
require_once('includes/dbcon.php');

// user
require_once('classes/Person_class.php');



$person = new Person();


if (isset($_POST ['email']) && isset($_POST['input_password']) ) {

	$person->logIn($_POST['email'], $_POST['input_password']);

}


$routes = array(
'default' => 'startpage_controller.php',
'about-us' => 'about_controller.php',
    
'product' => 'product_controller.php',
'create-product' => 'add_product_controller.php',
'edit-product' => 'edit_product_controller.php',
'update-product' => 'update_product_controller.php',
'all-products' => 'product_list_controller.php',
    
'category' => 'category_controller.php',
'create-category' => 'add_cat_controller.php',
'edit-category' => 'edit_cat_controller.php',
'update-category' => 'update_cat_controller.php', 
'all-categories' => 'categories_list_controller.php',
    
'addtocart' => 'cart_controller.php',
'updatecart' =>'cart_controller.php',
'removecartitem' => 'cart_controller.php',
'checkout' => 'checkout_controller.php', 
    
'login' => 'profile_controller.php',
'logout'=>'profile_controller.php',
'forgot_password' => 'forgot_pass_controller.php',
    
'saveProfileChanges' =>'save_controller.php',    
'delete_profile' =>'delete_profile_controller.php',
'delete_permanent_profile' =>'delete_permanent_profile_controller.php',
    
'create_user' => 'create_user_controller.php',
'edituser' => 'edituser_controller.php',
'update_user' => 'update_user_controller.php',
    
'order'=> 'create_order_controller.php',
'users' => 'users_controller.php',
'password'=>'password_controller.php',
    
'edit-page' => 'edit_page_controller.php',
'update-page' => 'update_page_controller.php',
    
'orders' => 'admin_orders_controller.php',
'searchOrder' => 'admin_orders_controller.php',
'singleOrder' => 'admin_orders_controller.php',
'updateOrderStatus' => 'admin_orders_controller.php'
);

if(isset($_GET['action'])){
    if (is_file('controllers/'.$routes[$_GET['action']])){
        require('controllers/'.$routes[$_GET['action']]);
    } else {
    	
        require('templates/404.php');
    }
    
} else {
    require('controllers/'.$routes['default']);
}

// Vi inkludar denna filen här för att den ska hämtas efter uppdatering av varukorgen.
require_once('includes/cart.php');
