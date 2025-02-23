<?php
function autoloader($class)
{
    include '../models/' . $class . '.php';
    include '../controllers/' . $class . '.php';
    include '../db/' . $class . '.php';
}

spl_autoload_register('autoloader');