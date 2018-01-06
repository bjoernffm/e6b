<?php

use \bjoernffm\e6b\Calculator as e6bCalc;

/**
 * @codeCoverageIgnore
 */
class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testGetWindCorrectionAngle1()
    {
        $result = e6bCalc::getWindCorrectionAngle(3, 97, 0, 0);
        $this->assertEquals(
            $result,
            [
                'windCorrectionAngle' => 0,
                'heading' => 3,
                'groundSpeed' => 97,
            ]
        );
    }

    public function testGetWindCorrectionAngle2()
    {
        $result = e6bCalc::getWindCorrectionAngle(90, 50, 360, 40);
        $this->assertEquals(
            $result,
            [
                'windCorrectionAngle' => -53,
                'heading' => 37,
                'groundSpeed' => 30,
            ]
        );
    }

    public function testGetWindCorrectionAngle3()
    {
        $result = e6bCalc::getWindCorrectionAngle(90, 50, 90, 40);
        $this->assertEquals(
            $result,
            [
                'windCorrectionAngle' => 0,
                'heading' => 90,
                'groundSpeed' => 10,
            ]
        );
    }

    public function testGetWindCorrectionAngle4()
    {
        $result = e6bCalc::getWindCorrectionAngle(407, 100, 603, 50);
        $this->assertEquals(
            $result,
            [
                'windCorrectionAngle' => -8,
                'heading' => 39,
                'groundSpeed' => 147,
            ]
        );
    }

    public function testGetWindcomponents1()
    {
        $result = e6bCalc::getWindcomponents(90, 60, 30);
        $this->assertEquals($result, ['crosswind' => 15, 'headwind' => 26]);

        $result = e6bCalc::getWindcomponents(30, 60, 30);
        $this->assertEquals($result, ['crosswind' => 15, 'headwind' => 26]);
    }

    public function testGetWindcomponents2()
    {
        $result = e6bCalc::getWindcomponents(0, 90, 15);
        $this->assertEquals($result, ['crosswind' => 15, 'headwind' => 0]);

        $result = e6bCalc::getWindcomponents(0, 270, 15);
        $this->assertEquals($result, ['crosswind' => 15, 'headwind' => 0]);
    }

    public function testGetWindcomponents3()
    {
        $result = e6bCalc::getWindcomponents(0, 0, 40);
        $this->assertEquals($result, ['crosswind' => 0, 'headwind' => 40]);

        $result = e6bCalc::getWindcomponents(180, 0, 40);
        $this->assertEquals($result, ['crosswind' => 0, 'headwind' => 0]);
    }

    public function testGetFlightTime1()
    {
        $result = e6bCalc::getFlightTime(5, 90);
        $this->assertEquals(
            $result,
            [
                'minutes' => 3,
                'formatted' => '00:03'
            ]
        );
    }

    public function testGetFlightTime2()
    {
        $result = e6bCalc::getFlightTime(25, -10);
        $this->assertEquals(
            $result,
            [
                'minutes' => INF,
                'formatted' => '--:--'
            ]
        );
    }

    public function testGetFlightTime3()
    {
        $result = e6bCalc::getFlightTime(0, -10);
        $this->assertEquals(
            $result,
            [
                'minutes' => INF,
                'formatted' => '--:--'
            ]
        );
    }

    public function testGetFlightTime4()
    {
        $result = e6bCalc::getFlightTime(0, 0);
        $this->assertEquals(
            $result,
            [
                'minutes' => 0,
                'formatted' => '00:00'
            ]
        );
    }

    public function testGetFlightTime5()
    {
        $result = e6bCalc::getFlightTime(2345, 123);
        $this->assertEquals(
            $result,
            [
                'minutes' => 1144,
                'formatted' => '19:04'
            ]
        );
    }

    public function testConvertKnots()
    {
        $result = e6bCalc::convertKnots(-10);
        $this->assertEquals($result, ['kph' => -19, 'mph' => -12]);

        $result = e6bCalc::convertKnots(0);
        $this->assertEquals($result, ['kph' => 0, 'mph' => 0]);

        $result = e6bCalc::convertKnots(1);
        $this->assertEquals($result, ['kph' => 2, 'mph' => 1]);

        $result = e6bCalc::convertKnots(10);
        $this->assertEquals($result, ['kph' => 19, 'mph' => 12]);

        $result = e6bCalc::convertKnots(100);
        $this->assertEquals($result, ['kph' => 185, 'mph' => 115]);
    }

    public function testConvertKilometersPerHour()
    {
        $result = e6bCalc::convertKilometersPerHour(-10);
        $this->assertEquals($result, ['knots' => -5, 'mph' => -6]);

        $result = e6bCalc::convertKilometersPerHour(0);
        $this->assertEquals($result, ['knots' => 0, 'mph' => 0]);

        $result = e6bCalc::convertKilometersPerHour(1);
        $this->assertEquals($result, ['knots' => 1, 'mph' => 1]);

        $result = e6bCalc::convertKilometersPerHour(10);
        $this->assertEquals($result, ['knots' => 5, 'mph' => 6]);

        $result = e6bCalc::convertKilometersPerHour(100);
        $this->assertEquals($result, ['knots' => 54, 'mph' => 62]);
    }

    public function testConvertMilesPerHour()
    {
        $result = e6bCalc::convertMilesPerHour(-10);
        $this->assertEquals($result, ['knots' => -9, 'kph' => -16]);

        $result = e6bCalc::convertMilesPerHour(0);
        $this->assertEquals($result, ['knots' => 0, 'kph' => 0]);

        $result = e6bCalc::convertMilesPerHour(1);
        $this->assertEquals($result, ['knots' => 1, 'kph' => 2]);

        $result = e6bCalc::convertMilesPerHour(10);
        $this->assertEquals($result, ['knots' => 9, 'kph' => 16]);

        $result = e6bCalc::convertMilesPerHour(100);
        $this->assertEquals($result, ['knots' => 87, 'kph' => 161]);
    }

    public function testConvertFeet()
    {
        $result = e6bCalc::convertFeet(0);
        $this->assertEquals($result, ['meters' => 0]);

        $result = e6bCalc::convertFeet(5413);
        $this->assertEquals($result, ['meters' => 1650]);

        $result = e6bCalc::convertFeet(37000);
        $this->assertEquals($result, ['meters' => 11278]);
    }
}
