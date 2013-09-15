<?php 

namespace view;

	/**
	 * @return String HTML
	 */
	 
class HTMLPage {
	public function getPage($body){
		return'<html>
					<head>
						<h1>Log in</h1>
					</head>
					<body>'. $body.'
					<p>'.  date('l jS \of F Y h:i:s A') .'</p>	
					</body>
				</html>';
	}
}
