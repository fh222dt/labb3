<?php
namespace controller;
require_once("view/loginv.php");
require_once("model/loginm.php");

class Login {
	private $view;
	private $model;

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

				if() {									//vad för nåt??????????????
					$user = $this->view->notLogedIn();
				}
			}
			catch (Exeption $e) {
				
			}

			var_dump($_POST);

		}

	}

}