<?php

Class FarmGame extends Farm {

    public $eaters_turn_count = [];
    public $turn_count = 0; // this is to maintain each turn count

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

    // Validate the input
    public function validateInput($input) {
        // In php 7.0 you can write i.e. isset($input['eaters_turn_count']) ?? null;
        $this->eaters_turn_count = isset($input['eaters']) ? $input['eaters']: null;

        /**
         * Note: I am not sending turnCount the first turn
         * TurnCount is set after the first turn and
         * then the same server turnCount is used for all operations
         * even after incrementing
         */
        $this->turn_count = isset($input['turnCount']) ? $input['turnCount']: 0;

        // check if farmer and turncount has right values
        if (isset($this->eaters_turn_count[$this->farmer_title]) 
            && $this->turn_count >= 0 && $this->turn_count < 50) {

            foreach ($this->eaters_turn_count as $entity_name => $ent_turn_count) {
                $entity_name_arr = explode(' ',ucfirst(strtolower($entity_name)));

                // check if other members are farm animals
                if ($entity_name_arr[0] != $this->farmer_title
                 && !in_array($entity_name_arr[0], $this->farm_animals))
                    return false;
            }
            return true;
        }
        return false;
    }


    public function invalidInput() {
        $data = [
            'status' => 'Invalid Input'
        ];
        echo json_encode($data);
        exit;
    }
}