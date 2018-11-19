<?php

Class FarmPlay extends FarmGame {

    public function death($entity_name) {
        unset($this->eaters_turn_count[$entity_name]);
        $this->dead[] = $entity_name;
    }

    public function feed($entity_name, $entity) {
        $this->c_alive[] = $entity;
        $this->eaters_turn_count[$this->fed_to] = 0;
    }

    public function maintainAlive($entity_name, $entity) {
        $this->c_alive[] = $entity; // maitain the ones who are alive
        ++$this->eaters_turn_count[$entity_name];
    }

    // calculate or set the current game scenario as per the UI or frontend
    public function playTurn() {
        $this->randomMemberToBeFed();
        foreach ($this->eaters_turn_count as $entity_name => $ent_turn_count) {
            $entity_name_arr = explode(' ',ucfirst(strtolower($entity_name)));
            $entity = $entity_name_arr[0];
            $name = '';
            if ($entity != $this->farmer_title)
                $name = '_' . $entity_name_arr[1];

            // Create player objects
            $obj_name = $entity . $name . '_obj';
            $$obj_name = new $entity();
            $$obj_name->cur_turn_count = $ent_turn_count + 1;

            if ($this->fed_to !== $entity_name) {
                if ($$obj_name->checkIfDead()) $this->death($entity_name);
                else $this->maintainAlive($entity_name, $entity);
            }
            else $this->feed($entity_name, $entity);
        }
        ++$this->turn_count; // increment every turn
    }

}