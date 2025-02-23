<?php
 require_once('utils/autoload.php');

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
} catch (Throwable $ex) {
    include dirname(__FILE__).'/controllers/404.php';
}