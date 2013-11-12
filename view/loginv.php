<?php

namespace view;

class Login {

	private $html = "";
	private $username = "";
	private $password = "";
	private $helpText = "";

	public function userWantsToLogin() {
		if (isset($_POST['submit'])) {
			return true;
		}
		else {
			return false;
		}		
	}

	public function loginUser() {
		//$username = $this->checkInput($this->username);
		//$password = $this->checkInput($this->password);

		$username = $_POST['username'];
		$password = $_POST['password'];

		if (!empty($_POST['username']) && !empty($_POST['password'])) {
				return new \model\login($username, $password);			
		}

		else {
			if(empty($_POST['username']) ) {
			$this->helpText = "Användarnamn saknas";
			
			}

			else if(empty($_POST['password']) ) {
			$this->helpText = "Lösenord saknas";
			
			}

			/*else {
			$this->helpText = "Felaktigt användarnamn och/eller lösenord";
			
			}*/

		}
	}

	public function notLogedIn() {
		$this->helpText = "Felaktigt användarnamn och/eller lösenord";
	}

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
				<input id='KeepLogin' name='KeepLogin' type='checkbox'> Håll mig inloggad</label>

				<input type='submit' name='submit' value='Logga in' class='btn'>
			</fieldset>
		</form>";

		return $html;
	}

	//OBS! blandade returvärden!!!! Lyft ut felmedelande t egna metoder!
	private function checkInput ($input) {

		/*if (isset($_POST[$input])) {
			return true;
		}*/	

		if(empty($_POST['username']) ) {
			return $this->helpText = "Användarnamn saknas";
		}

		else if(empty($_POST['password']) ) {
			return $this->helpText = "Lösenord saknas";
		}

		/*else {
			return $this->helpText = "Felaktigt användarnamn och/eller lösenord";
		}*/
	}

}