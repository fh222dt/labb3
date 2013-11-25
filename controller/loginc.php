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
			//testa ev kaka
			//if ($this->view->cookie == true) {
				//if ($this->model->testCookie() == true && $this->model->testSession() == true) {
					return $this->view->displayLogedIn();
				//}

				//else {}	
			//}			
			
		}

	}

	private function testUserInput () {
		//-----------------login utan cookies-----------------------
		//kolla i vyn vill anv logga in?
		if ($this->view->userWantsToLogin()) {			
			try {
				//ta in data från vyn
				$user = $this->view->getUser();

				//testa i modellen
				if ($this->model->loginUser($user) == false) {
					//visa resultat via vyn för ej inloggad
					$this->view->notLogedIn();						
				}				
				
				
				else {
					//visa resultat via vyn	
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

		//kolla i vyn vill anv logga in?
		if ($this->view->userWantsToLoginWCookie()) {		

		//ta in data från vyn
			$inputPsw = $this->view->getPassword();

		//testa i modellen
			if ($this->model->testUser($inputPsw) == false) {

				//visa resultat via vyn
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