<?php 

namespace view;

	/**
	 * @param String $title
	 * @param String $body
	 * @return String HTML
	 */
	
class HTMLPage {
	public function getPage($title, $body){
		setlocale(LC_ALL, "swedish");
		return'<html>
					<head>'
						. $title .'
						<link rel="Stylesheet" href="basic.css">
						<meta charset="UTF-8">
					</head>
					<body>'. $body.'
					<p class="time">'.  strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ') .'</p>	
					</body>
				</html>';
	}
	function fillValue($value){
return '<h2>Ej inloggad</h2>
		<fieldset>
			<legend>Skriv in användarnamn och lösenord</legend>
				<form method="post" action="?login">
					<label for="UserName">Användarnamn: </label>
					<input type="text" name="UserName" id="UserName" value="'.$value.'">
					<label for="Password">Lösenord: </label>
					<input type="password" name="Password" id="Password" value>
			      	<input type="submit" name="login" value="Logga in" />
		    	</form>';

}
}
