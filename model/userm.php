<?php
namespace model;

class User { 

	public $username = "";
	public $password = "";

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