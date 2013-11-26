<?php
namespace model;

class User { 
	//sträng för användarnamn
	public $username = "";
	//sträng för lösenord
	public $password = "";

	//skapa en användare
	//Tar 2 strängar som inparametrar
	public function __construct ($username, $password) {

		if ($username == "") {
            throw new \Exception("Måste ange användarnamn");
        }
        if ($password == "") {
            throw new \Exception("Måste ange lösenord");
        }

		$this->username = $username;
		$this->password = $password;
		
	}
}