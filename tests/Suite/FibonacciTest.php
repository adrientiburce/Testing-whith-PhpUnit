<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Controller\Fibonacci;

class FibonacciTest extends WebTestCase
{
    /**
     * @dataProvider getResults
     */
    public function testFibonacci($value, $result)
    {
        $fibonacci = new Fibonacci();
        $this->assertSame($result, $fibonacci->fibonacciResult($value));
    }

    public function getResults()
    {
        return array(
            [0, 0],
            [1, 1],
            [2, 1],
            [3, 2],
            [10, 55],
            [16, 987],
        );
    }
}