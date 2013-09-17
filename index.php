<?php 
require_once("HTMLPage.php");
require_once("loggedin.php");

session_start();

$pageView = new \view\HTMLPage();
$loggedInView = new \view\loggedIn();

if($_POST){
	$form = $pageView->fillValue($_POST['UserName']);
}
else {
	$form = '<h2>Ej inloggad</h2>
		<fieldset>
			<legend>Skriv in användarnamn och lösenord</legend>
				<form method="post" action="?login">
					<label for="UserName">Användarnamn: </label>
					<input type="text" name="UserName" id="UserName" value>
					<label for="Password">Lösenord: </label>
					<input type="password" name="Password" id="Password" value>
			      	<input type="submit" name="login" value="Logga in" />
		    	</form>';
}
				
$loggedIn ='<h2> Admin loggade in </h2>
		<p>Inloggningen lyckades</p><p><a id="logout" href="?logout">Logga ut</a></p>';
		
$logIn = '<h1>Laboration 1</h1>';


if (isset($_POST['login'])) {
	$_SESSION['username'] = $_POST['UserName'];
	$_SESSION['password'] = $_POST['Password'];
	
	if($_SESSION['username'] == "Admin" && $_SESSION['password'] == "Password"){
		$_SESSION['mySession'] = true;
		
		if (isset($_SESSION["mySession"]) && $_SESSION["mySession"])
			{
				$form = $loggedIn;				
			}
	}
	else if($_SESSION['username'] == ''){
		$form.='<p>Användarnamn saknas</p>';
		
	}
	else if( $_SESSION['password'] == ''){
		$form.='<p>Lösenord saknas</p>';
		$_POST['UserName'] = $_SESSION['username'];
	}
	else{ $form.='<p>Felaktigt användarnamn och/eller lösenord</p>';
	}
	unset($_SESSION);
	/*header("Location: index.php");*/
}

echo $pageView->getPage($logIn,$form.='</fieldset>');

if (isset($_SESSION["mySession"]) && $_SESSION["mySession"])
{
	$form = $loggedIn;
}
