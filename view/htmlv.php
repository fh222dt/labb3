<?php
namespace view;
require_once("view/loginv.php");



class Html {

	public function getPage($content) {
		$date = $this->displayDate();
		$name = $this->nameOfUser();		//hämta från nåt ställe!
		$html ="<html>
					<head>
					<meta charset='utf-8'>
					<title>Laboration 3</title>
					<link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
					<link rel='stylesheet' href='bootstrap/css/bootstrap-responsive.css'>
					</head>

					<body>
				 
					<h1>Laborationskod fh222dt</h1>"
					.$name
					.$content.
					$date.
					"</body>
				</html>";

		return $html;
	}

	private function displayDate() {

		setlocale (LC_TIME, "Swedish");
		$date = utf8_encode(strftime("<p>%A")); 
		$date.= strftime(", den " . "%#d %B %Y" . ". Klockan är [" . "%X" . "]</p>"); //formatet %#d är linux %e	anv %T ist f %X på servern
		return $date;
	}

	public function nameOfUser() {
		$html = "<h2>Ej inloggad</h2>";

		if(isset($_SESSION["login"])) {
			//$name = $_POST['username'];					//här är et tokigt!!!!!!!!!!!!!!!!!!!!!!!!
			//if($_SESSION["login"] >= 3) {
				$html = "<h2>Admin är inloggad</h2>";
			//}
		}
		//else {
			//$html = "<h2>Ej inloggad</h2>";
		//}

		
		
		return $html;
	}

}