<?php

require_once __DIR__.'/../General/set-headers.php';
require_once __DIR__.'/../General/autoload.php';

$input = $_POST;

$game_obj = new FarmPlay;

// Validate input 
if ($game_obj->validateInput($input)) {

    /**
     * Skill: SOLID Principles
     * make sure each function
     * performs only 1 task
     */

    /**
     * Calculate the current scenario only.
     * This function can be used if further to be played by command line
     */
    $game_obj->playTurn();

    // set messages for the round
    $game_obj->setRoundMessages();

    // Separated response module function
    $game_obj->endCurrentTurn();
}
else {
    $game_obj->invalidInput();
}