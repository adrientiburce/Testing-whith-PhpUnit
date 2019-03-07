<?php

namespace App\Controller;

class Fibonacci
{
    public function fibonacciResult($value)
    {
        if($value == 0) return 0;
        if($value < 3) return 1;
        return $this->fibonacciResult($value -1) + $this->fibonacciResult($value -2);
    }
}