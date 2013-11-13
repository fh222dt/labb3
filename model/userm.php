<?php
namespace model;

class User { 

	public $username = "";
	public $password = "";

	public function __construct ($username, $password) {

		if ($username == "")
            throw new \Exception("Cannot create user without name");
        if ($password == "")
            throw new \Exception("Cannot create user without psw");

		$this->username = $username;
		$this->password = $password;
		
	}
}