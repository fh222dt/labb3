<?php
namespace model;

class Login {

	//sträng med krypterat lösenord
	private $hashedPsw = "";
	//private $username = "";
	//private $password = "";
	private $correctUsername = "Admin";
	private $correctPassword = "Password";

	public function loginUser(User $user) {
		if($user->username == $this->correctUsername && $user->password == $this->correctPassword) {
			return true;			
		}

		else {
			return false;
		}
	}	

	//förstör cookies och sessionen
	public function logout() {			

			setcookie("username", "ended", strtotime( '-1 min' ));
			setcookie("password", "ended", strtotime( '-1 min' ));

			session_destroy();
	}
	
	//skapa cookies
	public function storeUser (User $user) {

		//$this->login($inputName, $inputPsw);
					
		$this->hashedPsw = crypt($user->password); 
		$endtime = strtotime( '+5 min' );

		file_put_contents("endtime.txt", "$endtime");
		file_put_contents("password.txt", "$this->hashedPsw");

		setcookie("username", $user->username, $endtime);
		setcookie("password", $this->hashedPsw, $endtime);			
	}

	public function testUser($inputPsw) {
		$correctPsw = file_get_contents("password.txt");

		if ($inputPsw == $correctPsw) {

			if ($this->testSession()==true && $this->testCookie()==true) {
				return true;
			}

			else {
				$this->logout();
				return false;
			}
		}
						
		else {
			$this->logout();
			return false;
		}

	}

	public function testCookie() {
	
		$cookieEndTime = file_get_contents("endtime.txt");

		if (time() > $cookieEndTime) {
			return false;
		} 

		else {
			return true;
		}		
	}

	//får detta vara i modellen???
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
	
}