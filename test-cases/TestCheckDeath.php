<?php

Class TestCheckDeath extends TestBase {

    public $r_input = [
        0 => 10,
        1 => 20,
        2 => 30,
    ];

    public function test() {
        $this->testRightInputs();
        TestGeneral::printLines($this->result);
    }

    public function checkOperation($input, $match, $test_type) {
        $array = ['Farmer', 'Cow', 'Bunny'];
        $this->result[] = 'Test: ' . $test_type;
        foreach ($array as $farm_mem) {
            $farm_mem_obj = new $farm_mem();
            foreach ($input as $key => $value) {
                $deadFlag = false;
                for ($i =0; $i <= $value; ++$i) {
                    $farm_mem_obj->cur_turn_count = $i;
                    if ($farm_mem_obj->checkIfDead()) {
                        $deadFlag = true;
                        break;
                    }
                }
                if ($deadFlag)
                    $this->successResult($key, "Successful Death of $farm_mem on Round $i");
                else
                    $this->failedResult($value, $key, "No death of $farm_mem on Round $i");
            }
        }
    }

}