<?php

namespace view;
require_once("model/userm.php");

class Login {
	//sträng med utdata
	private $html = "";
	//sträng med användarnamn
	private $username = "";
	//sträng med lösenord
	private $password = "";
	//sträng med feedback t användaren
	private $helpText = "";
	//boolean med värde för kaka eller ej
	public $cookie = false;
	//boolean med värde för inloggning med kaka eller ej
	private $cookielogin = false;

	//returnerar true om anv vill logga in
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

	//returnerar true om anv vill logga in med kaka
	public function userWantsToLoginWCookie() {
		if ((isset($_COOKIE["username"])) && isset($_SESSION["login"])== null) {
			return true;
		}
		else {
			return false;
		}		
	}

	//returnerar true om anv är inloggad
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

	//returnerar true om anv vill logga ut
	public function userWantsToLogOut () {
		if (isset($_GET['logout'])) {
			return true;
		}
		else {
			return false;
		}		
	}

	//returnerar en anv av klassen User, felhanterar indata från anv
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

	//returnerar ett lösenord från en kaka
	public function getPassword () {
		$inputPsw = $_COOKIE["password"];
		return $inputPsw;
	}

	//presenterar felmedelande
	public function falseUser() {

		unset($_SESSION['login']);			
		return $this->helpText = "Felaktig information i cookie";
	}

	//presenterar felmedelande
	public function notLogedIn() {
		$this->helpText = "Felaktigt användarnamn och/eller lösenord";
	}

	//starta en inloggning
	public function doLogIn () {
		$_SESSION['login'] = 1;	
			
		header("Location: ?login");
	}

	//Starta en inloggning från kaka
	public function loginFromCookie() {
		$_SESSION['login'] = 2;
		$this->cookielogin = true;
	}

	//presenterar inloggningsformulär
	public function displayForm () {
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

	//presenterar feedback på inloggning
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

	//testar om sessionen är korrekt
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

	//presenterar feedback vid utloggning
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