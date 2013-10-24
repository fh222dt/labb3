<?php

namespace view;

class Login {

	private $html = "";

	public function displayForm ($helpText) {
		$value = isset($_POST['UserName']) ? $_POST['UserName'] : '';

		$html = "<form method='post' action='index.php' class='form-inline'>
		<fieldset>
			<legend>Login - Skriv in användarnamn och lösenord</legend>

			<p>$helpText</p>

			<label for='UserName'>Användarnamn</label>
			<input id='UserName' name='UserName' type='text' size='15' 
			value='$value'>		

			<label for='Password'>Lösenord</label>
			<input id='Password' name='Password' type='password' size='15'>

			<label for='KeepLogin' class='checkbox'> 
			<input id='KeepLogin' name='KeepLogin' type='checkbox'> Håll mig inloggad</label>

			<input type='submit' name='submit' value='Logga in' class='btn'>
		</fieldset>
	</form>";

		return $html;
	}

	public function displayDate() {

		setlocale (LC_TIME, "Swedish");
		echo utf8_encode(strftime("<p>%A")); 
		echo strftime(", den " . "%#d %B %Y" . ". Klockan är [" . "%X" . "]</p>"); //formatet %#d är linux %e	anv %T ist f %X på servern
	}

	public function htmlStart () {
		$html = "<html>
					<head>
					<meta charset='utf-8'>
					<title>Laboration 2</title>
					<link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
					<link rel='stylesheet' href='bootstrap/css/bootstrap-responsive.css'>
					</head>

					<body>
				 
					<h1>Laborationskod fh222dt</h1>";

		return $html;
	}

	public function htmlStop () {
		$html = "	</body>
				</html>";

		return $html;
	}

}