<?php

use \bjoernffm\e6b\DescendPathCalculator as e6bCalc;

/**
 * @codeCoverageIgnore
 */
class DescendPathCalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testGetPathByDescendRate()
    {
        $result = e6bCalc::getPathByDescendRate(110, 1000, 5000, 0);
        $this->assertEquals(
            $result,
            [
                'nauticalMiles' => 9.59,
                'minutes' => 5.0,
                'path' => [
                    ["nauticalMiles" => 0, "altitude" => 5000,"minutes" => 0],
                    ["nauticalMiles" => 1.99, "altitude" => 4000,"minutes" => 1],
                    ["nauticalMiles" => 3.94, "altitude" => 3000,"minutes" => 2],
                    ["nauticalMiles" => 5.86, "altitude" => 2000,"minutes" => 3],
                    ["nauticalMiles" => 7.74, "altitude" => 1000,"minutes" => 4],
                    ["nauticalMiles" => 9.59, "altitude" => 0,"minutes" => 5]
                ]
            ]
        );
    }

    public function testGetPathByDescendRateWithRest()
    {
        $result = e6bCalc::getPathByDescendRate(110, 700, 2000, 0);
        $this->assertEquals(
            $result,
            [
                'nauticalMiles' => 5.47,
                'minutes' => 2.86,
                'path' => [
                    ["nauticalMiles" => 0,"altitude" => 2000,"minutes" => 0],
                    ["nauticalMiles" => 1.89,"altitude" => 1300,"minutes" => 1],
                    ["nauticalMiles" => 3.76,"altitude" => 600,"minutes" => 2],
                    ["nauticalMiles" => 5.47,"altitude" => 0,"minutes" => 2.86]
                ]
            ]
        );
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Parameter $ias needs to be greater than 0
     */
    public function testGetPathByDescendRateWithInvalidArguments1()
    {
        $result = e6bCalc::getPathByDescendRate(0, 700, 2000, 0);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Parameter $descentRate needs to be greater than 0
     */
    public function testGetPathByDescendRateWithInvalidArguments2()
    {
        $result = e6bCalc::getPathByDescendRate(110, -700, 2000, 0);
    }

    /**
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Parameter $initialAltitude needs to be greater than $targetAltitude
     */
    public function testGetPathByDescendRateWithInvalidArguments3()
    {
        $result = e6bCalc::getPathByDescendRate(110, 700, 2000, 3000);
    }
}
