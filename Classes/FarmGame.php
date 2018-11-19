<?php

Class FarmGame extends Farm {

    public $eaters_turn_count = [];
    public $turn_count = 0; // this is to maintain each turn count
    public $fed_to; // current one to be fed
    public $c_alive = []; // categories who survived the turn
    public $alive = []; // ones who survived the turn (not in use currently)
    public $dead = []; // Ones who died on the turn

    // We can maintain this as a constant
    public $total_turn_count = 50; // max turns

    // Plus minus the values to maintain min win ones required
    protected $farm_win_entities = ['Farmer','Cow','Bunny'];

    // Display status and message as per the current scenario
    public $game_msg = [
        'msg' => [],
        'status' => 'Play again'
    ];

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

    // Chooses the one to be fed
    public function randomMemberToBeFed() {

        /**
         * PHP Skill: use native functions
         * Get all keys of an array in an array
         * Pick a random value from an array
         */
        $only_eaters_arr = array_keys($this->eaters_turn_count);
        $get_rand_eater_key = array_rand($only_eaters_arr);
        $this->fed_to = $only_eaters_arr[$get_rand_eater_key];
    }

    public function checkIfWon() {
        if ($this->turn_count == $this->total_turn_count) {

            if (empty(array_diff($this->farm_win_entities,
                array_unique($this->c_alive))))
                $this->game_msg['status'] = 'You win.';
            else $this->game_msg['status'] = 'Game Over. You Didn\'t Win';
        }
    }

    public function deathMessages() {
        foreach ($this->dead as $entity_name) {
            $this->game_msg['msg'][] = 'Dead: '. $entity_name;
            if ($entity_name == $this->farmer_title)
                $this->game_msg['status'] = 'Game Over. You Didn\'t Win';
        }
    }

    public function setRoundMessages() {
        $this->game_msg['msg'][] = 'Fed: '. $this->fed_to; // who was fed
        $this->checkIfWon(); // Check if won
        $this->deathMessages(); // The ones who died
    }

    // send response for the particular scenario
    public function endCurrentTurn() {
        $data = [
            'eaters' => $this->eaters_turn_count,
            'turnCount' => $this->turn_count,
            'message' => $this->game_msg
        ];
        echo json_encode($data);
        exit;
    }

    public function invalidInput() {
        $data = [
            'status' => 'Invalid Input'
        ];
        echo json_encode($data);
        exit;
    }
}