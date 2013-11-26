<?php
namespace controller;
require_once("view/loginv.php");
require_once("model/loginm.php");

class Login {
	private $view;
	private $model;

	public function __construct() {
		$this->view = new \view\Login();
		$this->model = new \model\Login();
		
	}

	public function LoginUser () {

		$this->testUserInput();

		if ($this->view->userIsLogedIn() == false) {
		
			return $this->view->displayForm();
		}

		else {	
			
			return $this->view->displayLogedIn();			
		}
	}

	private function testUserInput () {
		//-----------------login utan cookies-----------------------
		
		if ($this->view->userWantsToLogin()) {			
			try {				
				$user = $this->view->getUser();
				
				if ($this->model->loginUser($user) == false) {
					
					$this->view->notLogedIn();						
				}					
				
				else {					
					if ($this->view->cookie == true) {
						$this->model->storeUser($user);
					}					
						$this->view->doLogIn();
				}
			}
			catch (\Exception $e) {

			}
		}

		//-----------------login utifrån cookies---------------------

		if ($this->view->userWantsToLoginWCookie()) {		

			$inputPsw = $this->view->getPassword();

			if ($this->model->testUser($inputPsw) == false) {
				$this->view->falseUser();
			}

			else {
				$this->view->loginFromCookie();
			}
		}
		//--------------------logga ut--------------------------

		if ($this->view->userWantsToLogOut()) {
			$this->model->logout();
			$this->view->doLogOut();
		}

	}

}