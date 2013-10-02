<?php

require_once("HTMLPage.php");

/**
 * Application runs the application and checks the values 
 * used for login, then generates a message and calls the right method.
 */
class Application{
	/**
	 * @var string
	 */
	private static $username = "UserName";
	
	/**
  	 * @var string
	 * */
	private static $password = "Password";
	
	/**
	 * @var string
	 */
	private static $mySession = "mySession";
	
	/**
	 * @var string
	 */
	private static $logOut = "logout";
	
	/**
	 * @var string
	 */	
	private $messageString = null;
	
	/** 
	 *  Run application
	 *  @throws Exception if something goes wrong
	 */
	public function runApplication(){
		try{
			/**
			 * @var HTMLPage 
			 */
			$HTMLPage = new HTMLPage;
			
			if (isset($_POST[self::$logOut])) {
				$HTMLPage->getLogOutPage();
			}
			
			if ($_POST) {
				if (isset($_POST)) {
					if ($_POST[self::$username] == "Admin" && $_POST[self::$password] == "Password") {
						$_SESSION[self::$mySession] = true;
						
						if(isset($_POST['AutoLogin'])){
					 		$this->checkAutoLogin();
							
							$this->messageString = '<p>Inloggning lyckades och vi kommer ihåg dig nästa gång</p>';
						}
						else{			
							$this->messageString = '<p>Inloggningen lyckades</p>';
						}
					} 
					else if (empty($_POST[self::$username])) {
						$this->messageString = '<p>Användarnamn saknas</p>';
					} 
					else if (empty($_POST[self::$password])) {
						$this->messageString = '<p>Lösenord saknas</p>';
					} 
					else {
						 $this->messageString = '<p>Felaktigt användarnamn och/eller lösenord</p>';
					}
				}
			
			
			}
			if (isset($_COOKIE["password"])&& isset($_COOKIE["username"])){
					
				$cryptedPassword = $_COOKIE["password"];
			
				if(($_COOKIE["username"] == "Admin" && $_COOKIE["password"] == $cryptedPassword) && !isset($_SESSION[self::$mySession])){
						
					$this->messageString = '<p>Inloggning lyckades via cookies</p>';						
				}
			}
				
			if(isset($_SESSION[self::$mySession]) || isset($_COOKIE["password"])&& isset($_COOKIE["username"])) {
			$HTMLPage->getLoggedInPage($this->messageString);
			}
		
			else {
				$HTMLPage->getPage($this->messageString);
			}
		}
		catch(Exception $ex)
		{
			echo "Something went wrong.";
		}
	}
	public function checkAutoLogin(){
		
		setcookie("username", $_POST[self::$username], time()+3600);
		$this->cryptedPassword = crypt($_POST[self::$password]);
		setcookie("password", $this->cryptedPassword, time()+3600);	
		
		
	}		
}
