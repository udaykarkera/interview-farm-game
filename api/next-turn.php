<?php

/**
 * Not the right place for these headers,
 * but as no common route keeping it here.
 * In a bigger application, would be in the main entry file where all
 * hits to application are recieved and are further redirected ahead.
 */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$input = $_POST;

// Autoload Classes
spl_autoload_register('myAutoloader');
function myAutoloader($class_name)
{
    require_once __DIR__.'/../Classes/' . $class_name.'.php';
}

$game_obj = new FarmPlay;

// Validate input 
if ($game_obj->validateInput($input)) {

}
else {
    $game_obj->invalidInput();
}