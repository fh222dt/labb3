<?php
namespace controller;
require_once("view/loginv.php");
require_once("model/loginm.php");

class Login {
	private $view;

	public function __construct() {
		$this->view = new \view\login();
	}

	public function DoLogin () {

		//visa formuläret
		$this->view = $this->view->displayForm();

		if(isset($_POST['submit'])) {
			//spara data i vyn
			
		}


		return $this->view;

	}

}