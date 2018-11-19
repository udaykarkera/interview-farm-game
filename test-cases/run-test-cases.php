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

/**
 * With the help of the below code
 * you can test both on Web and terminal
 *
 */
$test_type = '';
if (isset($_GET['test']))
    $test_type = $_GET['test'];
else if (isset($argv[1]))
    $test_type = $argv[1];

switch ($test_type) {

    // This test is to test the input if they are correct
    case 'validate-input':
        $obj = new TestValidateInput;
        break;
    // This test is to test the operations taken place on each turn
    case 'play-turn':
        $obj = new TestPlayTurn;
        break;
    // This test is to test the no of turns for death of farm member
    case 'check-if-dead':
        $obj = new TestCheckDeath;
        break;
    default:
        $obj = new TestValidateInput;
    break;
}


/**
 * This function will test according
 * to their respective test cases
 *
 */
$obj->test();
exit;