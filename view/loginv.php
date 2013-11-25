<?php

namespace view;
//require_once("model/loginm.php");		//behövs inte kankse????????
require_once("model/userm.php");

class Login {

	private $html = "";
	private $username = "";
	private $password = "";
	private $helpText = "";
	public $cookie = false;
	private $session = $_SESSION["login"];

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

	/*public function userWantsToLoginWCookie() {
		if (isset($_POST['submit']) && isset($_POST['keeplogin']) ) {
			return true;
		}
		else {
			return false;
		}		
	}*/

	public function userIsLogedIn(){			//kan behövas med get login sen för cookielogin
		if (isset($this->session)) {
			return true;
		}

		if (isset($_COOKIE["username"])) {
			return true;
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

	public function notLogedIn() {
		$this->helpText = "Felaktigt användarnamn och/eller lösenord";
	}

	public function doLogIn () {
		$this->session = 1;	

		if ($this->cookie == true)	{
			//gör något m cookies
		}	
			
		header("Location: ?login");

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
		if (isset($this->session)) {
			//if ($this->testSession()==true) {						
				//$html = "<h2> $this->username är inloggad</h2>";
				$html = "";				
				
				$this->session = $this->session+1;

				if $this->session < 4) {					
					if (isset($_COOKIE["username"])) {
						
						$html= "<p>Inloggningen lyckades och vi kommer ihåg dig nästa gång</br></p>";
					}

					else {
						
						$html.="<p>Inloggningen lyckades </br></p>";						
					}
				}			
				
				$html.="<a href='?logout'>Logga ut</a>";
			
			//}

			/*else {
				unset($_SESSION["login"]);
				session_destroy();
				header("Location: $_SERVER[PHP_SELF]");
			}	*/	

				return $html;

		}
	}

	//används inte!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	/*private function checkInput ($input) {

		/*if (isset($_POST[$input])) {
			return true;
		}	

		if(empty($_POST['username']) ) {
			return $this->helpText = "Användarnamn saknas";
		}

		else if(empty($_POST['password']) ) {
			return $this->helpText = "Lösenord saknas";
		}

		/*else {
			return $this->helpText = "Felaktigt användarnamn och/eller lösenord";
		}
	}*/

	//logga ut & förstör cookies och sessionen
	public function doLogOut () {	
		
		if(!isset($this->session)) {
				return "";
		}

		else {		
			unset($this->session);
			
			return $this->helpText = "Du har nu loggat ut";
		}
	}

	
}