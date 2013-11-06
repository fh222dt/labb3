<?php
namespace model;

class Login {

	//skapa cookies
	public function StoreUser ($inputName, $inputPsw) {

		$this->login($inputName, $inputPsw);

		if (isset($_SESSION["login"])) {			
			$this->hashedPsw = crypt($inputPsw); 
			$endtime = strtotime( '+5 min' );

			file_put_contents("endtime.txt", "$endtime");
			file_put_contents("password.txt", "$this->hashedPsw");

			setcookie("username", $inputName, $endtime);
			setcookie("password", $this->hashedPsw, $endtime);
		}		
	}

	//testar sessionen mot kapning
	//true loggar in, false tillbaka till formuläret
	public function testSession() {

		$sessionLocation = "testSession";

		if(isset($_SESSION[$sessionLocation]) == false) {
			$_SESSION[$sessionLocation] = array();
			$_SESSION[$sessionLocation]["browser"] = $_SERVER["HTTP_USER_AGENT"];
			$_SESSION[$sessionLocation]["ip"] = $_SERVER["REMOTE_ADDR"];
		}

		if ($_SESSION[$sessionLocation]["browser"] != $_SERVER["HTTP_USER_AGENT"] ||
			$_SESSION[$sessionLocation]["ip"] != $_SERVER["REMOTE_ADDR"]) {
			
			return false;
		}

		else {
			return true;
		}

	}

	//testar att cookien är aktuell
	//true loggar in, false tillbaka till formuläret
	public function testCookie() {

		if (isset($_COOKIE["username"])) {
			$cookieEndTime = file_get_contents("endtime.txt");

			if (time() > $cookieEndTime) {
				return false;
			} 

			else {
				return true;
			}
		}
	}

	//logga ut & förstör cookies och sessionen
	public function logout () {	
		
		if(!isset($_SESSION["login"])) {
				return "";
		}

		else {				

			setcookie("username", "ended", strtotime( '-1 min' ));
			setcookie("password", "ended", strtotime( '-1 min' ));

			unset($_SESSION["login"]);
			session_destroy();

			return "<p>Du har nu loggat ut</p><br/>";
		}
	}
	
}