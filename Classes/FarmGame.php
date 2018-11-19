<?php

Class FarmGame extends Farm {


    // We can maintain this as a constant
    public $total_turn_count = 50; // max turns

    // Plus minus the values to maintain min win ones required
    protected $farm_win_entities = ['Farmer','Cow','Bunny'];

    /**
     * Fetch the Game Details here to play
     * This gives the initial setup config for the UI
     */
    public function sendGameDetails() {
        $data = [
            'farmEntities' => $this->farm_entities,
            'farmWinEntities' => $this->farm_win_entities,
            'totalturnCount' => $this->total_turn_count,
            'farmerTitle' => $this->farmer_title
        ];
        echo json_encode($data);
        exit;
    }
}