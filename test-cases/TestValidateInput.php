<?php

Class TestValidateInput extends TestBase
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

    public $f_input = [
        0 => [
            'turnCount' => 5
        ],
        1 => [
            'eaters' => [
                'Cow 1'=> 0,
                'Cow 2'=> 0,
                'Bunny 1'=> 0,
                'Bunny 2'=> 0,
                'Bunny 3'=> 0,
                'Bunny 4'=> 0,
            ],
        ],
        2 => [
            'eaters' => [
                'Farmer'=> 'asdasd',
                'Cow 1'=> 0,
                'Cow 2'=> 0,
                'Bunny 1'=> 0,
                'Bunny 2'=> 0,
                'Bunny 3'=> 0,
                'Bunny 4'=> 0,
            ],
            'turnCount' => 4
        ],
    ];

    public function test() {

        // Try hiting with the right inputs
        $this->testRightInputs();
        // Try hiting with the wrong inputs
        $this->testFalseInputs();
        TestGeneral::printLines($this->result);
    }

    public function checkOperation($input, $match, $test_type) {
        $os = new FarmPlay;

        foreach ($input as $key => $value) {
            $response_value = $os->validateInput($value);
            $this->result[] = 'Test: ' . $test_type;
            $msg = 'Turn Count';
            if ($response_value === $match) $this->successResult($key, $msg);
            else $this->failedResult($value, $key, $msg);
        }
    }

}