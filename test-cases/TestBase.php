<?php

Class TestBase {
    public $validate_input;

    public $result = [];

    public function __constructor()
    {
        $this->validate_input = new FarmPlay;
    }

    public function __destructor()
    {
        $this->validate_input = NULL;
    }

    public function testRightInputs()
    {
        $this->checkOperation($this->r_input, true, 'Right Inputs');
    }

    public function testFalseInputs()
    {
        $this->checkOperation($this->f_input, false, 'Wrong Inputs');
    }

    public function successResult($key, $msg) {
        $this->result[] = "Input: ($msg) " . $key . ' Test Ok.';
    }

    public function failedResult($value, $key, $msg) {
        $this->result[] = "Input: ($msg) " . $key . ' Test Failed.';
        $this->result[] = "Request: " . json_encode($value);
    }

}