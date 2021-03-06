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
	 * @var int
	 */
	private $endtime;
	
	/**
	 * @var string
	 */
	private $cryptedPassword;
	
	/**
	 * @var string
	 */
	private $passwordFromFile;
	
	/**
	 * @var string
	 */
	private $browser;
	
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
			
			
			if (isset($_GET[self::$logOut])) {
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
				$this->cryptedPassword = $_COOKIE["password"];	
				
				if(($_COOKIE["username"] == "Admin" && $_COOKIE["password"] == $this->cryptedPassword) && !isset($_SESSION[self::$mySession])){
						
					$this->messageString = '<p>Inloggning lyckades via cookies</p>';
					
					$cookieEndtime = file_get_contents("endtime.txt");
					
					if($cookieEndtime < time()){
						setcookie("username", "",time()-3600);
						setcookie("password", "",time()-3600);
								
						$this->messageString = '<p>Felaktig information i cookie</p>';						
					}						
				}
				$this->passwordFromFile = file_get_contents("password.txt");
					if($this->cryptedPassword != $this->passwordFromFile)
					{
						$this->messageString = "<p>Felaktig information i cookie</p>";
						setcookie("username", "",time()-3600);
						setcookie("password", "",time()-3600);
					}
			}
			
			if (!isset($_SESSION["checkBrowser"])){
				$_SESSION["checkBrowser"] = array();
				$_SESSION["checkBrowser"]["browser"] = self::getUserAgent();
			}
			$cookieEndtime = file_get_contents("endtime.txt");
			
			if($_SESSION["checkBrowser"]["browser"] != self::getUserAgent()){
				$HTMLPage->getPage($this->messageString);
			}
			else if(isset($_SESSION[self::$mySession])) {
			$HTMLPage->getLoggedInPage($this->messageString);
			}
			else if($this->cryptedPassword != $this->passwordFromFile){
				$HTMLPage->getPage($this->messageString);
			}
			else if (isset($_COOKIE["password"])&& isset($_COOKIE["username"]) && $cookieEndtime > time()){
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
	/**
	 * Magical fix, emil tar reda på varför den funkar genom att tvinga daniel att göra det.
	 */
	public static function getUserAgent()
	{
	    static $agent = null;
	
	    if ( empty($agent) ) {
	        $agent = $_SERVER['HTTP_USER_AGENT'];
	
	        if ( stripos($agent, 'Firefox') !== false ) {
	            $agent = 'firefox';
	        } elseif ( stripos($agent, 'MSIE') !== false ) {
	            $agent = 'ie';
	        } elseif ( stripos($agent, 'iPad') !== false ) {
	            $agent = 'ipad';
	        } elseif ( stripos($agent, 'Android') !== false ) {
	            $agent = 'android';
	        } elseif ( stripos($agent, 'Chrome') !== false ) {
	            $agent = 'chrome';
	        } elseif ( stripos($agent, 'Safari') !== false ) {
	            $agent = 'safari';
	        } elseif ( stripos($agent, 'AIR') !== false ) {
	            $agent = 'air';
	        } elseif ( stripos($agent, 'Fluid') !== false ) {
	            $agent = 'fluid';
	        }	
	    }	
	    return $agent;
	}

	public function checkAutoLogin(){
		
		$this->endtime = time() + 30;
		file_put_contents("endtime.txt", $this->endtime);
		setcookie("username", $_POST[self::$username], $this->endtime);
		$this->cryptedPassword = crypt($_POST[self::$password]);
		setcookie("password", $this->cryptedPassword, $this->endtime);	
		
		file_put_contents("password.txt", $this->cryptedPassword);
	}		
}
