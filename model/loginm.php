<?php
namespace model;

class Login {

	//sträng med krypterat lösenord
	private $hashedPsw = "";
	private $correctUsername = "Admin";
	private $correctPassword = "Password";

	//Returnerar true om rätt användarnamn & lösen angetts 
	public function loginUser(User $user) {
		if($user->username == $this->correctUsername && $user->password == $this->correctPassword) {
			return true;			
		}

		else {
			return false;
		}
	}	
	
	//skapa cookies
	public function storeUser (User $user) {

		$this->hashedPsw = crypt($user->password); 
		$endtime = strtotime( '+5 min' );

		file_put_contents("endtime.txt", "$endtime");
		file_put_contents("password.txt", "$this->hashedPsw");

		setcookie("username", $user->username, $endtime);
		setcookie("password", $this->hashedPsw, $endtime);			
	}

	//testa befintligt users lösenord och gammal kaka. 
	//Returnerar true om det är rätt lösen & inte för gammal kaka.
	public function testUser($inputPsw) {
		$correctPsw = file_get_contents("password.txt");

		if ($inputPsw == $correctPsw) {

			if ($this->testCookie()==true) {
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

	//testa cookies som redan finns. Returnerar true om cokkien inte är för gammal
	public function testCookie() {
	
		$cookieEndTime = file_get_contents("endtime.txt");

		if (time() > $cookieEndTime) {
			return false;
		} 

		else {
			return true;
		}		
	}	

	//förstör cookies och sessionen
	public function logout() {			

			setcookie("username", "ended", strtotime( '-1 min' ));
			setcookie("password", "ended", strtotime( '-1 min' ));

			session_destroy();
	}	
}