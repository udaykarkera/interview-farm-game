<?php

// Autoload Classes
spl_autoload_register('myAutoloader');
function myAutoloader($class_name)
{
    require_once __DIR__.'/../Classes/' . $class_name.'.php';
}