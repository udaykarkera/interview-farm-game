<?php

Class Farmer implements CanDie {

    // You can maintain this as private to hide the no of turns to death
    private $max_turn_count = 15;

    public $cur_turn_count = 0;

    /**
     * This function can be an example of polymorphism.
     * Where sharing an interface, the fucntions could behave
     * according to thier respective Class
     */
    public function checkIfDead() {
        if ($this->max_turn_count <= $this->cur_turn_count)
            return true;
        else return false;
    }

}