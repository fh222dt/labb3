<?php
namespace controller;
require_once("view/loginv.php");
require_once("model/loginm.php");

class Login {
	private $view;

	public function __construct() {
		$this->view = new \view\Login();
	}

	public function LoginUser () {

		$this->testUserInput();

		return $this->view->displayForm();

	}

	private function testUserInput () {
		if ($this->view->userWantsToLogin()) {
			try {
				$user = $this->view->loginUser();
			}
			catch (Exeption $e) {

			}

		}

	}

}