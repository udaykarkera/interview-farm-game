<?php

require_once __DIR__.'/../General/set-headers.php';
require_once __DIR__.'/../General/autoload.php';


$game_obj = new FarmPlay;

/**
 * Fetch the Game Details here to play
 * This gives the initial setup config for the UI
 */
$game_obj->sendGameDetails();

exit;