<?php
 phpinfo();
require_once('core/autoload.php');
include 'db/db.php';

Db::init();

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
    $controller = new $route();
    $controller->action_post($_REQUEST);
}
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $controller = new $route();
    $controller->action_index();
}
} catch (Throwable $ex) {
    include dirname(__FILE__).'/controllers/404.php';
}