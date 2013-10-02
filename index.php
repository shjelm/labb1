<?php

require_once("Application.php");

session_start();

$applicationView = new Application;
$applicationView->runApplication();



/**echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
echo '<hr>';
echo '<pre>';
var_dump($_GET);*/