<?php
namespace controller;
require_once("view/loginv.php");
class Login {

	public function DoLogin () {

		$view = new \view\login();

		echo $view->htmlStart();


		echo $view->displayDate();
		echo $view->htmlStop();

	}

}