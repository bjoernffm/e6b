<?php

use \bjoernffm\e6b\DescendPathCalculator;

/**
 * @codeCoverageIgnore
 */
class DescendPathCalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testGetPathByDescendRate()
    {
        $dpc = new DescendPathCalculator([
            'initialAltitude'       => 37000,
            'targetAltitude'   => 3000,
            'transitionLevel'   => 70,
            'qnh'       => 995,
            'descendMach' => 0.78,
            'descendKIAS' => 270,
            'descendRate' => 2500,
            'reduce' => true
        ]);

        $dpc->run();
    }
}
