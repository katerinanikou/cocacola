<?php

// Inloggning till databasen
$settings['db']['user'] = 'root';
$settings['db']['password'] = 'root';
$settings['db']['host'] = 'localhost';
$settings['db']['database'] = 'granza';


// Uppladdning av filer
$settings['upload_dir'] = "uploads/";

// Debug
$settings['debug'] = false;

if ($settings['debug']) {
	echo "<pre>";
	var_dump($settings);
	echo "</pre>";
}