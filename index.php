<?php

session_start();
require_once("controller/loginc.php");			//controllern

$controller = new controller\login();
$controller->DoLogin();

