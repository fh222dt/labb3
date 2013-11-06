<?php

session_start();
require_once("controller/loginc.php");
require_once("view/htmlv.php");

$controller = new controller\login();
$content= $controller->DoLogin();
$html = new view\html();

echo $html->getPage($content);

