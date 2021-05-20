<?php


namespace App\Controllers;


class sum
{
    private float $value1;
    private float $value2;
    private httpResponse $httpResponse;

    public function __construct($value1, $value2)
    {
        $this->value1 = floatval($value1);
        $this->value2 = floatval($value2);
        $this->httpResponse = new httpResponse();
    }

    public function sum()
    {
        return $this->value1 + $this->value2;
    }


}