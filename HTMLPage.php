<?php 

namespace view;

	/**
	 * @return String HTML
	 */
	 
class HTMLPage {
	public function getPage($body){
		setlocale(LC_ALL, "swedish");
		return'<html>
					<head>
						<h1>Logga in</h1>
						<link rel="Stylesheet" href="basic.css">
						<meta charset="UTF-8">
					</head>
					<body>'. $body.'
					<p class="time">'.  strftime('%A, den %d %B år %Y. Klockan är: [%H:%M:%S] ') .'</p>	
					</body>
				</html>';
	}
}
