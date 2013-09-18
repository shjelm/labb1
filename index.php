<?php 

session_start();

$message = null;

if(isset($_POST['logout'])){
	getLogOutPage();
}

if(isset($_POST)){	
	if($_POST['UserName'] == "Admin" && $_POST['Password'] == "Password"){
		$_SESSION['mySession'] = true;
	}
	else if(empty($_POST['UserName'])){
		$message='<p>Användarnamn saknas</p>';
			}
	else if(empty($_POST['Password'])){
		$message='<p>Lösenord saknas</p>';
	}
	else{ $message='<p>Felaktigt användarnamn och/eller lösenord</p>';
	}
}
			
if(isset($_SESSION['mySession'])){
	getLoggedInPage();
}
else{
	getPage($message);
}

function getPage($message){
	$value = null;
	
	if(isset($_POST['UserName'])){
		$value = $_POST['UserName'];
	}
	
	$html  ='<html>
					<head>
						<title> Laboration 1 sh222mw </title>
						<link rel="Stylesheet" href="basic.css">
						<meta charset="UTF-8">
					</head>
					<body>
						<h2>Ej inloggad</h2>
						<fieldset>
							<legend>Skriv in användarnamn och lösenord</legend>
								<form method="post" action="index.php">
									<label for="UserName">Användarnamn: </label>
									<input type="text" name="UserName" id="UserName" value="'.$value.'">
									<label for="Password">Lösenord: </label>
									<input type="password" name="Password" id="Password" value="">
							      	<input type="submit" name="login" value="Logga in" />
						    	</form>';
								
			    	$html.= $message;
						
					$html.= '</fieldset>
				    <p class="time">'.getClock().'</p>	
					</body>
				</html>';
				
		
	
	echo $html;
}

function getLoggedInPage(){
	$loggedInHTML = '<html>
					<head>
						<title> Laboration 1 sh222mw </title>
						<link rel="Stylesheet" href="basic.css">
						<meta charset="UTF-8">
					</head>
					<body>
						<h2> Admin loggade in </h2> 
						<p>Inloggningen lyckades</p>
						<form method="post" action="">
						<input type="submit" name="logout" value="Logga ut" /> 
						</form>
						<p class="time">'.getClock().'</p>	
					</body>
				</html>';
				
				echo $loggedInHTML;
}

function getLogOutPage(){
	unset($_SESSION['mySession']);
	
	$message = "Du har loggat ut";
	
	getPage($message);
	exit;
}

function getClock(){
	setlocale(LC_ALL, "swedish");
	return strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ');
}
