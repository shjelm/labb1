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
			
						$this->messageString = '<p>Inloggningen lyckades</p>';
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
			assert(isset($this->messageString));
			
			if (isset($_SESSION[self::$mySession])) {
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
}
