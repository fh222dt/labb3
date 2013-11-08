<?php
namespace view;

class Html {
	public function getPage($content) {
		$date = $this->displayDate();
		$html ="<html>
					<head>
					<meta charset='utf-8'>
					<title>Laboration 3</title>
					<link rel='stylesheet' href='bootstrap/css/bootstrap.css'>
					<link rel='stylesheet' href='bootstrap/css/bootstrap-responsive.css'>
					</head>

					<body>
				 
					<h1>Laborationskod fh222dt</h1>"
					
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
}