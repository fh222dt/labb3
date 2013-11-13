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

		return $this->view->displayForm();

	}

	private function testUserInput () {
		//-----------------login utan cookies-----------------------
		//kolla i vyn vill anv logga in?
		if ($this->view->userWantsToLogin()) {			
				try {
					//ta in data från vyn
					$user = $this->view->getUser();

					//testa i modellen												//om koden fr r 31 och framåt körs funkar inte felhanteringen i view!
					if ($this->model->loginUser($user) == false) {
						//visa resultat via vyn
						$this->view->notLogedIn();						
					}
					
					//if($user == false) {
					else {
						//visa resultat via vyn									
						$this->view->isLogedIn();
					}
				}
				catch (\Exception $e) {

				}
			

			var_dump($_POST);

		}

		//-----------------login med cookies---------------------

		//kolla i vyn vill anv logga in?

		//ta in data från vyn

		//testa i modellen

		//visa resultat via vyn


		//--------------------logga ut--------------------------

		//kolla i vyb vill anv logga ut?

		//ta in data från vyn

		//avsluta i modellen

		//visa resultat via vyn

	}

}