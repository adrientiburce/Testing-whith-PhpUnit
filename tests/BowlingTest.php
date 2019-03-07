<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BowlingTest extends WebTestCase
{
    /**
     * we generate an array filled with :
     * @var i 
     */
    public function generateArray($i)
    {
        $A = array_fill(0, 20, $i);
        return $A;
    }

    public function getTotalScore($A)
    {
        $res = 0;
        $i = 0;
        while ($i < count($A)){
            if($this->isStrike($A, $i)){
                $res += $A[$i] + $A[$i+2] + $A[$i+3];
            }
            elseif($this->isSpare($A, $i)){
                $res += $A[$i] + $A[$i+1] + $A[$i+2];
            }
            else $res += $A[$i] + $A[$i+1];
            $i += 2;
        } 
        return $res;
    }

    public function isSpare($A, $i)
    {
        if($A[$i] + $A[$i+1] == 10 && $A[$i] != 0) return true;
        return false;
    }
    public function isStrike($A, $i)
    {
        if($A[$i] == 10 && $A[$i + 1] == 0){
            return true;
        }
        return false;
    }


// My Tests

    public function testNullscore()
    {
        $nullArray = $this->generateArray(0);
        $this->assertSame(0, $this->getTotalScore($nullArray));
    }

    public function testOnlyOnes()
    {
        $onesArray = $this->generateArray(1);
        $this->assertSame(20, $this->getTotalScore($onesArray));
    }

    public function testSpare()
    {
        $spareArray = $this->generateArray(2);
        $spareArray[1] = 8;
        $this->assertSame(48, $this->getTotalScore($spareArray));
    }

    public function testStrike()
    {
        $strikeArray = $this->generateArray(0);
        $strikeArray[0] = 10;
        $strikeArray[2] = $strikeArray[3] = 2;
        $this->assertSame(18, $this->getTotalScore($strikeArray));
    }
}
