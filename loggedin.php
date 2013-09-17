<?php

namespace view;

class loggedIn{
	function getLoggedInPage() {
		echo '<html>
							<head>
								<h1>Log in</h1>
							</head>
							<body>
								<h1> Admin är inloggad </h1>
								<p><a href="?logout">Logga ut</a></p>
							</body>
						</html>';
				}
}