<?php
function autoloader($class)
{
    include 'models/' . $class . '.php';
    include 'controllers/' . $class . '.php';
    include $class . '.php';
}

spl_autoload_register('autoloader');