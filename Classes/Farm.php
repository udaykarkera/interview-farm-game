<?php


/**
 * Setting it to abstract
 * so that none can instantiate it
 * 
 */
abstract Class Farm {
    // Ones to be fed in a farm
    protected $farm_entities = [
        'Farmer','Cow 1','Cow 2','Bunny 1','Bunny 2','Bunny 3','Bunny 4'
    ];

    // On this fellow death, game ends
    public $farmer_title = 'Farmer';

    // Animals in the farm
    protected $farm_animals = ['Cow', 'Bunny'];

}