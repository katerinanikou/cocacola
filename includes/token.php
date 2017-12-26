<?php

if(!function_exists('getToken')){
function getToken() {
    if (!isset($_SESSION['token'])){
        $_SESSION['token'] = uniqid("", true);
    }
}
}

if(!function_exists('checkToken')){
    function checkToken($token){
        
        if (!isset($_SESSION['token']) || !isset($token) || $token !== $_SESSION['token']){
            destroyToken();    
            //Behåller personen på samma sida den kom ifrån.
            $refererURL = $_SERVER['HTTP_REFERER'];
            //header('Location:'.$refererURL);
            return false;
        } else {
            destroyToken();
            return true;
        }
    }
}

if(!function_exists('getTokenField')){
    function getTokenField(){
        return '<input type="hidden" name="token" value="'.$_SESSION["token"].'">'; 
    }
}

if(!function_exists('destroyToken')){
    function destroyToken(){
        unset($_SESSION['token']);
        unset($token);
    }
}