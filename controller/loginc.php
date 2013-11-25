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
			return $this->view->displayLogedIn();
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
				
				//if($user == false) {
				else {
					//visa resultat via vyn	
					if ($this->view->cookie == true) {
						$this->model->storeUser($user);
					}

					//else {
						$this->view->doLogIn();
					//}
				}
			}
			catch (\Exception $e) {

			}
		}

		//-----------------login med cookies---------------------

		//kolla i vyn vill anv logga in?
		//if ($this->view->userWantsToLoginWCookie()) {
				//inget bra, det får bli en ifsats i vyn nån stans som kollar cookie eller ej
		//}

		//ta in data från vyn

		//testa i modellen

		//visa resultat via vyn


		//--------------------logga ut--------------------------

		if ($this->view->userWantsToLogOut()) {
			$this->model->logout();
			$this->view->doLogOut();
		}

	}

}