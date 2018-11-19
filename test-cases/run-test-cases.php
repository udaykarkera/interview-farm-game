<?php

// Autoload Classes
spl_autoload_register('myAutoloader');
function myAutoloader($class_name)
{
    if (strpos($class_name, 'Test') !== false)
        require_once __DIR__. '/' .$class_name.'.php';
    else
        require_once __DIR__.'/../Classes/' . $class_name.'.php';
}

$test_type = '';
if (isset($_GET['test']))
    $test_type = $_GET['test'];
else if (isset($argv[1]))
    $test_type = $argv[1];

switch ($test_type) {
    case 'validate-input':
        $obj = new TestValidateInput;
        break;
    case 'play-turn':
        $obj = new TestPlayTurn;
        break;
    case 'check-if-dead':
        $obj = new TestCheckDeath;
        break;
    default:
        $obj = new TestValidateInput;
    break;
}
$obj->test();
