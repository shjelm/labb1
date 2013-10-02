<?php

require_once("Application.php");

session_start();

$applicationView = new Application;
$applicationView->runApplication();



