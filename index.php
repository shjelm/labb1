<?php

<<<<<<< HEAD
require_once("Application.php");

session_start();

$applicationView = new Application;
$applicationView->runApplication();


=======
session_start();

$message = null;
$successMessage = null;

if (isset($_POST['logout'])) {
	getLogOutPage();
}

if ($_POST) {
	if (isset($_POST)) {
		if ($_POST['UserName'] == "Admin" && $_POST['Password'] == "Password") {
			$_SESSION['mySession'] = true;

			$successMessage = '<p>Inloggningen lyckades</p>';
		} else if (empty($_POST['UserName'])) {
			$message = '<p>Användarnamn saknas</p>';
		} else if (empty($_POST['Password'])) {
			$message = '<p>Lösenord saknas</p>';
		} else { $message = '<p>Felaktigt användarnamn och/eller lösenord</p>';
		}
	}
}

if (isset($_SESSION['mySession'])) {
	getLoggedInPage($successMessage);
} else {
	getPage($message);
}

function getPage($message) {
	$value = null;

	if (isset($_POST['UserName'])) {
		$value = $_POST['UserName'];
	}

	$html = '<!DOCTYPE HTML>
			 <html>
					<head>
						<title> Laboration 1 sh222mw </title>
						<link rel="Stylesheet" href="basic.css">
						<meta charset="UTF-8">
					</head>
					<body>
						<h1>Laboration 1 sh222mw</h1>
						<h2>Ej inloggad</h2>
						<fieldset>
							<legend>Skriv in användarnamn och lösenord</legend>
								<form method="post" action="?login">
									<label for="UserName">Användarnamn: </label>
									<input type="text" name="UserName" id="UserName" value="' . $value . '">
									<label for="Password">Lösenord: </label>
									<input type="password" name="Password" id="Password" value="">
							      	<input type="submit" name="login" value="Logga in" />
						    	</form>';

	$html .= $message;

	$html .= '</fieldset>
			    <p class="time">' . getClock() . '</p>	
				</body>
			</html>';

	echo $html;
}

function getLoggedInPage($successMessage) {
	$loggedInHTML = '<!DOCTYPE HTML>
					 <html>
						<head>
							<title> Laboration 1 sh222mw </title>
							<link rel="Stylesheet" href="basic.css">
							<meta charset="UTF-8">
							<h1>Laboration 1 sh222mw</h1>
						</head>
						<body>
							<h2> Admin är inloggad </h2>' . $successMessage . ' 
							<form method="post" action="?logout">
							<input type="submit" name="logout" value="Logga ut" /> 
							</form>
							<p class="time">' . getClock() . '</p>	
						</body>
					</html>';

	echo $loggedInHTML;
}

function getLogOutPage() {
	unset($_SESSION['mySession']);

	$message = "<p>Du har loggat ut</p>";

	getPage($message);
	exit ;
}

function getClock() {
	setlocale(LC_ALL, "swedish");
	return strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ');
}
>>>>>>> 9da4330cdb06b39cd30f84adbbd54014d4a4576e
