<?php

namespace view;
require_once("model/userm.php");

class Login {

	private $html = "";
	private $username = "";
	private $password = "";
	private $helpText = "";
	public $cookie = false;
	private $cookielogin = false;

	public function userWantsToLogin() {
		if (isset($_POST['submit'])) {
			if(isset($_POST['keeplogin'])) {
				$this->cookie = true;
			}
			return true;
		}
		else {
			return false;
		}		
	}

	public function userWantsToLoginWCookie() {
		if ((isset($_COOKIE["username"])) && isset($_SESSION["login"])== null) {
			return true;
		}
		else {
			return false;
		}		
	}

	public function userIsLogedIn(){
		if (isset($_SESSION['login'])) {
			if($this->testSession() == true) {
				return true;
			}	
		}

		else {
			return false;
		}		
	}

	public function userWantsToLogOut () {
		if (isset($_GET['logout'])) {
			return true;
		}
		else {
			return false;
		}		
	}

	public function getUser() {
		
		$this->username = $_POST['username'];
		$this->password = $_POST['password'];

		try {					
			return new \model\User($this->username, $this->password);
		}
		catch (\Exception $e) {
			if(empty($_POST['username']) ) {
			$this->helpText = "Användarnamn saknas";
			throw $e;	
			}

			else if(empty($_POST['password']) ) {
			$this->helpText = "Lösenord saknas";
			throw $e;
			}
		}			
	}

	public function getPassword () {
		$inputPsw = $_COOKIE["password"];
		return $inputPsw;
	}

	public function falseUser() {

		unset($_SESSION['login']);			
		return $this->helpText = "Felaktig information i cookie";
	}

	public function notLogedIn() {
		$this->helpText = "Felaktigt användarnamn och/eller lösenord";
	}

	public function doLogIn () {
		$_SESSION['login'] = 1;	
			
		header("Location: ?login");
	}

	public function loginFromCookie() {
		$_SESSION['login'] = 2;
		$this->cookielogin = true;
	}

	public function displayForm () { 		//fixa till post mm i början
		$value = isset($_POST['username']) ? $_POST['username'] : '';


		$html = "<form method='post' action='index.php' class='form-inline'>
			<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend>

				<p>$this->helpText</p>

				<label for='username'>Användarnamn</label>
				<input id='username' name='username' type='text' size='15' 
				value='$value'>		

				<label for='Password'>Lösenord</label>
				<input id='Password' name='password' type='password' size='15'>

				<label for='KeepLogin' class='checkbox'> 
				<input id='KeepLogin' name='keeplogin' type='checkbox'> Håll mig inloggad</label>

				<input type='submit' name='submit' value='Logga in' class='btn'>
			</fieldset>
		</form>";

		return $html;
	}

	public function displayLogedIn() {
		if (isset($_SESSION['login'])) {
			$html = "";				
			
			$_SESSION['login'] = $_SESSION['login']+1;

			if ($_SESSION['login'] < 4) {					
				if ($this->cookielogin == true) {
					$html.="<p>Inloggningen lyckades via cookies</br></p>";					
				}

				else if (isset($_COOKIE["username"])) {
					$html.= "<p>Inloggningen lyckades och vi kommer ihåg dig nästa gång</br></p>";
				}

				else {
					
					$html.="<p>Inloggningen lyckades </br></p>";						
				}
			}			
			
			$html.="<a href='?logout'>Logga ut</a>";

			return $html;
		}
	}

	public function testSession() {

		$sessionLocation = "testSession";

		if(isset($_SESSION[$sessionLocation]) == false) {
			$_SESSION[$sessionLocation] = array();
			$_SESSION[$sessionLocation]["browser"] = $_SERVER["HTTP_USER_AGENT"];
			$_SESSION[$sessionLocation]["ip"] = $_SERVER["REMOTE_ADDR"];
		}

		if ($_SESSION[$sessionLocation]["browser"] != $_SERVER["HTTP_USER_AGENT"] ||
			$_SESSION[$sessionLocation]["ip"] != $_SERVER["REMOTE_ADDR"]) {
			
			unset($_SESSION['login']);
			return false;
		}

		else {
			return true;
		}

	}

	//logga ut & förstör cookies och sessionen
	public function doLogOut () {	
		
		if(!isset($_SESSION['login'])) {
				return "";
		}

		else {		
			unset($_SESSION['login']);
			
			return $this->helpText = "Du har nu loggat ut";
		}
	}
	
}