<?php

Class TestPlayTurn extends TestBase
{

    public $r_input = [
        0 => [
            'eaters' => [
                'Farmer'=> 1,
                'Cow 1'=> 3,
                'Cow 2'=> 4,
                'Bunny 1'=> 4,
                'Bunny 2'=> 3,
                'Bunny 3'=> 5,
                'Bunny 4'=> 3,
            ],
        ],
        1 => [
            'eaters' => [
                'Farmer'=> 2,
                'Cow 1'=> 4,
                'Cow 2'=> 5,
                'Bunny 1'=> 6,
                'Bunny 2'=> 4,
                'Bunny 3'=> 5,
                'Bunny 4'=> 0,
            ],
            'turnCount' => 43
        ],
        2 => [
            'eaters' => [
                'Farmer'=> 3,
                'Cow 1'=> 2,
                'Cow 2'=> 7,
                'Bunny 1'=> 1,
                'Bunny 2'=> 3,
                'Bunny 3'=> 0,
                'Bunny 4'=> 0,
            ],
            'turnCount' => 0
        ],
    ];

    public function test() {
        $this->testRightInputs();
        TestGeneral::printLines($this->result);
    }

    public function checkOperation($input, $match, $test_type) {
        $os = new FarmPlay;

        foreach ($input as $key => $value) {
            if ($os->validateInput($value)) {
                $os->playTurn();
                $response_value = $os->eaters_turn_count;
                $response_turn_count = $os->turn_count;
                $this->result[] = 'Test: ' . $test_type;
                foreach ($response_value as $res_key => $res_value) {
                    $msg = "Eaters: ($res_key)";

                    /**
                     * This checks when the turn count for each
                     * farm member after each turn is correct or not.
                     * 
                     */
                    if ($res_value == 0 || $res_value == $value['eaters'][$res_key] + 1)
                        $this->successResult($key, $msg);
                    else
                        $this->failedResult($value, $key, $msg);
                }

                /**
                 * This checks when the turn count of the
                 * entire game after each turn is correct or not.
                 * 
                 */
                if (isset($value['turnCount'])) {
                    $msg = 'Turn Count =+ 1';
                    if ($value['turnCount'] + 1 == $response_turn_count )
                        $this->successResult($key, $msg);
                    else
                        $this->failedResult($value, $key, $msg);
                }
                else {
                    $msg = 'Turn Count = 1';
                    if ($response_turn_count == 1)
                        $this->successResult($key, $msg);
                    else
                        $this->failedResult($value, $key, $msg);
                }
            }
            else {
                $this->failedResult($value, $key, 'Validation Error');
            }
        }
    }

}