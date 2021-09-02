<?php
ini_set('display_errors', 1);
require_once 'vendor/autoload.php';
session_start();
/*echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
$cont = new app\controllers\TaskControler();
$cont->action();