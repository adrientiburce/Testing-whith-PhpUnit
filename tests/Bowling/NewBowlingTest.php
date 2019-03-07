<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NewBowlingTest extends WebTestCase
{
    public function getTotalScore($A)
    {
        $res = 0;
        $i = 0;
        while ($i < count($A)){
            if($this->isStrike($A, $i)){
                if($i > count($A) - 3){
                    break;
                }
                else{
                    $res += $A[$i] + $A[$i+1] + $A[$i+2];
                }
                $i += 1;
            }
            elseif($this->isSpare($A, $i)){
                $res += $A[$i] + $A[$i+1]+ $A[$i+2];
                $i += 2;
            }
            else{
                $res += $A[$i] + $A[$i+1];
                $i += 2;
            }
        } 
        return $res;
    }

    public function isSpare($A, $i)
    {
        if($A[$i] + $A[$i+1] == 10) return true;
        return false;
    }
    public function isStrike($A, $i)
    {
        if($A[$i] == 10){
            return true;
        }
        return false;
    }

    /**
     * @dataProvider getData
     * @group new-test
     */
    public function testNullscore($result, $value)
    {
        $this->assertSame($result, $this->getTotalScore($value));
    }

    public function getData()
    {
        return array(
            [0, array_fill(0, 20, 0)],  //test only null
            [20, array_fill(0, 20, 1)],  // only ones
            [29, array(4, 6, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)], // spare !
            [30, array(10, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1)], // 1 strike !
            [300, array(10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10)] // 12 strike : score maxi !
        );
    }
}
