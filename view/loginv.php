<?php

namespace view;

class Login {

	private $html = "";

	public function displayForm () {
		$value = isset($_POST['UserName']) ? $_POST['UserName'] : '';

		$html = "<form method='post' action='index.php' class='form-inline'>
			<fieldset>
				<legend>Login - Skriv in användarnamn och lösenord</legend>

				

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

	public function saveFormInput () {
		$inputName = $_POST["UserName"];
		$inputPsw = $_POST["Password"];

		return; //vad?
	}

	private function checkInput () {
		if (isset($_POST["submit"])){		
			if(empty($inputName) ) {
				return $helpText= "Användarnamn saknas";
			}

			else if(empty($inputPsw) ) {
				return $helpText= "Lösenord saknas";
			}

			else {
				return $helpText= "Felaktigt användarnamn och/eller lösenord";
			}

			//returnera nåt??
		}
	}

}