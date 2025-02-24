<?php
require_once('bootstrap.php');
header("Cache-Control: no-cache, must-revalidate"); 
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 

try {
    $route = trim($_REQUEST['route']??'index');
if (substr($route,'-1') == '/'){
    $route.='index';
}

if (!preg_match('~^[-a-z0-9/_]+$~i', $route)){
    throw new Exception('Not allowed route');
}

$filePath = dirname(__FILE__).'/controllers/'.$route.'.php';

if (!file_exists($filePath)){ 
    throw new Exception('Route not found');
}

include $filePath;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new Controllers\Registration();
    $controller->action_post($_POST);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new Controllers\Registration();
    $controller->action_index();
}



} catch (Throwable $ex) {
    echo 404;
    include dirname(__FILE__).'/controllers/404.php';
}