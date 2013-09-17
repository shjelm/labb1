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
}
