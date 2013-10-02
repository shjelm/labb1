<?php 

/**
 * HTMLPage generates the page 
 * */

class HTMLPage{
	/**
	 * @var $string HTML
	 * */
	private $html = null;
	
	/**
	 * @var string
	 */
	private static $username = "UserName";
	
	/**
	 * @var string
	 */
	private static $mySession = "mySession";
	
	/**
	 * @return String HTML
	 */
	private function startOfHTML(){
		return '<!DOCTYPE HTML>
					   <html>
							<head>
								<title> Laboration 1 sh222mw </title>
								<link rel="Stylesheet" href="basic.css">
								<meta charset="UTF-8">
							</head>
							<body>
							<h1>Laboration 1 sh222mw</h1>';	
	}
	
	/**  
	 * @param string, a message
	 * @return String HTML
	 */
	public function getPage($messageString) {
		/**
		 * @var string
		 */		 
		$value = null;
	
		if (isset($_POST[self::$username])) {
			$value = $_POST[self::$username];
		}
		
		$this->html = $this->startOfHTML();
		
		$this->html .= '	<h2>Ej inloggad</h2>
							<fieldset>
								<legend>Skriv in användarnamn och lösenord</legend>
									<form method="post" action="?login">
										<label for="UserName">Användarnamn: </label>
										<input type="text" name="UserName" id="UserName" value="' . $value . '">
										<label for="Password">Lösenord: </label>
										<input type="password" name="Password" id="Password" value="">
								      	<input type="submit" name="login" value="Logga in" />
							    	</form>';
	
		$this->html .= $messageString;
	
		$this->html .= '</fieldset>'.
						$this->getClock();
	
		echo $this->html;
	}

	/**  
	 * @param string, message
	 * @return String HTML
	 */
	public function getLoggedInPage($successMessageString) {
		
		$this->html = $this->startOfHTML();
		$this->html .= '		<h2> Admin är inloggad </h2>' . $successMessageString . ' 
								<form method="post" action="?logout">
								<input type="submit" name="logout" value="Logga ut" /> 
								</form>'.
								$this->getClock();
		echo $this->html;
	}
	
	/**
	 * @return String HTML
	 */
	public function getLogOutPage() {
		unset($_SESSION[self::$mySession]);
	
		$this->messageString = "<p>Du har loggat ut</p>";
	
		$this->getPage($this->messageString);
		exit;
	}
	
	/**  
	 * @return String HTML with time
	 */
	private function getClock() {
		setlocale(LC_ALL, "swedish");
		
		/**
		 * @var string 
		 */
		$time = strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ');
		
		return '				<p class="time">' . $time . '</p>	
							</body>
						</html>';
	}
}