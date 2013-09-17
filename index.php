<?php 

require_once("HTMLPage.php");
require_once("loggedin.php");

$pageView = new \view\HTMLPage();
$loggedInView = new \view\loggedIn();

$form ='<h2>Ej inloggad</h2>
			<form method="post" action="?login">
			<label for:"UserName">Användarnamn: </label>
			<input type:"text" name="UserName" id="UserName" value>
			<label for="Password">Lösenord: </label>
			<input type="password" name="Password" id="Password" value>
	      	<input type="submit" name="login" value="Logga in" />
	    </form>';
$loggedIn ='<h1> Admin loggade in </h1>
		<p>Inloggningen lyckades</p><p><a href="?logout">Logga ut</a></p>';

if (isset($_POST['login'])) {
	if($_POST['UserName'] == "Admin" && $_POST['Password'] == "Password"){
		$form =$loggedIn;
	}	
	else if($_POST['UserName'] == ''){
		$form.='<p>Användarnamn saknas</p>';
	}
	else if( $_POST['Password'] == ''){
		$form.='<p>Lösenord saknas</p>';
	}
	else{ $form.='<p>Felaktigt användarnamn och/eller lösenord</p>';
	}
}

echo $pageView->getPage($form);


/*if (isset($_POST['login'])) {
	if($_POST['username'] == "admin"){
		$loggedInView->getLoggedInPage();
  echo $_POST['username'];
  echo $_POST['password'];
	}
}*/