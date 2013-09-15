<?php 

require_once("HTMLPage.php");
require_once("loggedin.php");

$pageView = new \view\HTMLPage();
$loggedInView = new \view\loggedIn();

$form ='<form method="post" action="?login">
				<label for:"UserName">Username: </label>
				<input type:"text" name="UserName" id="UserName" value>
				<label for="Password">Password: </label>
				<input type="password" name="Password" id="Password" value>
		      	<input type="submit" name="login" value="Log in" />
	    </form>';
$loggedIn ='<h1> Admin signed in </h1>
		<p>Successfully logged in </p><p><a href="?logout">Log out</a></p>';
				   		
echo $pageView->getPage($form);

if (isset($_POST['login'])) {
	if($_POST['UserName'] == "Admin" && $_POST['Password'] == "Password"){
		echo $pageView->getPage($loggedIn);
	}
	else{ echo $pageView->getPage('<p>Incorrect username and/or password</p>');
	}
	if($_POST['UserName'] == ''){
		echo $pageView->getPage('<p>Användarnamn saknas</p>');
	}
	else if( $_POST['Password'] == ''){
		echo $pageView->getPage('<p>Lösenord saknas</p>');
	}
}


/*if (isset($_POST['login'])) {
	if($_POST['username'] == "admin"){
		$loggedInView->getLoggedInPage();
  echo $_POST['username'];
  echo $_POST['password'];
	}
}*/